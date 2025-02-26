<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity_files".
 *
 * @property int $id
 * @property int|null $activity_id
 * @property string|null $files_name
 * @property string|null $file_type
 * @property string|null $extension
 * @property string|null $file_path
 * @property float|null $file_size
 * @property int|null $user_id
 */
class ActivityFiles extends \yii\db\ActiveRecord
{
    public $images, $documents;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id'], 'integer'],
            [['files_name', 'file_type', 'file_path', 'extension'], 'string', 'max' => 255],
            [['file_size'], 'number'],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png,jpeg', 'checkExtensionByMimeType' => true, 'mimeTypes' => ['image/jpeg', 'image/png']],
            [['documents'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc,docx,pdf,xls,xlsx', 'checkExtensionByMimeType' => true, 'mimeTypes' => ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'files_name' => 'Files Name',
            'file_type' => 'File Type',
            'extension' => 'Extension',
            'file_path' => 'File Path',
            'file_size' => 'File Size',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Handle the file upload process
     * @return bool
     */
    public function uploadFiles()
    {
        if ($this->validate()) {
            if ($this->images) {
                $this->saveFile($this->images, 'image');
            }
            if ($this->documents) {
                $this->saveFile($this->documents, 'document');
            }
            return true;
        }
        return false;
    }

    /**
     * Save the uploaded file
     * @param $file UploadedFile
     * @param $type string
     */
    protected function saveFile($file, $type)
    {
        $this->files_name = Yii::$app->security->generateRandomString() . '.' . $file->extension;
        $this->file_type = $type;
        $this->extension = $file->extension;
        $this->file_size = $file->size;
        $this->file_path = 'uploads/' . $this->files_name;

        if ($file->saveAs(Yii::getAlias('@webroot') . '/' . $this->file_path)) {
            $this->save(false); // Save the model without validation as it's already validated
        }
    }
}
