<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\HttpException;
use yii\web\UploadedFile;

/**
 * This is the model class for table "uploadfiles".
 *
 * @property int $id
 * @property string|null $hospcode
 * @property string|null $filename
 * @property float|null $filesize
 * @property float|null $rec
 * @property string|null $upload_datetime
 * @property int|null $user_id
 */
class Uploadfiles extends ActiveRecord
{
    public $uploadFolder = 'uploads';
    public $uploadedFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploadfiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filesize', 'rec'], 'number'],
            [['upload_datetime'], 'safe'],
            [['user_id'], 'integer'],
            [['hospcode'], 'string', 'max' => 5],
            [['filename'], 'string', 'max' => 255],
            [['uploadedFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv', 'checkExtensionByMimeType' => false, 'mimeTypes' => 'text/csv, application/vnd.ms-excel'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospcode' => 'Hospcode',
            'filename' => 'Filename',
            'filesize' => 'Filesize',
            'rec' => 'Record Count',
            'upload_datetime' => 'Upload Datetime',
            'user_id' => 'User ID',
            'uploadedFile' => 'Upload File',
        ];
    }

    /**
     * Handle the file upload and import process
     * @return int the number of rows imported or 0 if none
     * @throws HttpException
     */
    public function import()
    {
        // รับไฟล์ที่อัปโหลด
        $this->uploadedFile = UploadedFile::getInstance($this, 'uploadedFile');
        if (!$this->uploadedFile || !$this->validate()) {
            throw new HttpException(400, 'ไฟล์ไม่ถูกต้องหรือการอัปโหลดล้มเหลว');
        }

        // ตรวจสอบและสร้างโฟลเดอร์อัปโหลดถ้าไม่มี
        $path = Yii::getAlias('@webroot') . '/' . $this->uploadFolder . '/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // บันทึกไฟล์ที่อัปโหลด
        $this->filename = Yii::$app->security->generateRandomString() . '.' . $this->uploadedFile->extension;
        $filePath = $path . $this->filename;
        if (!$this->uploadedFile->saveAs($filePath)) {
            throw new HttpException(500, 'ไม่สามารถบันทึกไฟล์ที่อัปโหลดได้');
        }

        // เก็บข้อมูลไฟล์
        $this->filesize = $this->uploadedFile->size;
        $this->upload_datetime = date('Y-m-d H:i:s');

        if (!$this->save(false)) {
            throw new HttpException(500, 'ไม่สามารถบันทึกข้อมูลไฟล์อัปโหลดได้');
        }

        // เปิดไฟล์ CSV และเริ่มนำเข้าข้อมูล
        if (($fileHandler = fopen($filePath, 'r')) === false) {
            throw new HttpException(500, 'ไม่สามารถเปิดไฟล์ได้');
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $isFirstRow = true;
            $rowCount = 0;

            while (($line = fgetcsv($fileHandler)) !== false) {
                if ($isFirstRow) {
                    $isFirstRow = false; // ข้ามแถวหัวข้อ
                    continue;
                }

                if (count($line) < 14) {
                    // ข้ามแถวที่ข้อมูลไม่ครบ
                    continue;
                }

                // เตรียมข้อมูลสำหรับนำเข้า
                $data = [
                    'hospcode' => $line[0],
                    'pid' => $line[1],
                    'birth' => $line[2],
                    'sex' => $line[3],
                    'hn' => $line[4],
                    'seq' => $line[5],
                    'date_serv' => $line[6],
                    'diagtype' => $line[7],
                    'diagcode' => $line[8],
                    'clinic' => $line[9],
                    'provider' => $line[10],
                    'd_update' => $line[11],
                    'cid' => $line[12],
                    'appoint' => $line[13],
                ];

                // นำเข้าข้อมูลเข้าสู่ฐานข้อมูล
                Yii::$app->db->createCommand()->upsert('smog_import', $data)->execute();
                $rowCount++;
            }

            fclose($fileHandler);
            @unlink($filePath); // ลบไฟล์หลังจากประมวลผล

            $transaction->commit();

            // อัปเดตจำนวนข้อมูลที่นำเข้า
            $this->rec = $rowCount;
            $this->save(false);

            return $rowCount;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new HttpException(500, 'การนำเข้าข้อมูลล้มเหลว: ' . $e->getMessage());
        }
    }

    /**
     * Relation to the Chospital model
     * @return \yii\db\ActiveQuery
     */
    public function getChospital()
    {
        return $this->hasOne(Chospital::class, ['hoscode' => 'hospcode']);
    }
}
