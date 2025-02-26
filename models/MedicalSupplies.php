<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class MedicalSupplies extends ActiveRecord
{
    public static function tableName()
    {
        return 'medical_supplies';
    }

    // เพิ่ม relation กับตาราง cprovince
    public function getCchangwat()
    {
        Yii::debug($this->provcode, 'relation');
        return $this->hasOne(Cchangwat::class, ['provcode' => 'provcode']);
    }

    public function getProvcode()
    {
        return $this->provcode;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'type', 'quantity'], 'required'],
            [['quantity'], 'integer', 'min' => 0],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 100],
            [['hospname'], 'string', 'max' => 255],
            [['hospcode'], 'string', 'max' => 5],
            [['provcode'], 'string', 'max' => 2],
            [['created_by', 'updated_by'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อเวชภัณฑ์',
            'type' => 'ประเภท',
            'quantity' => 'จำนวน',
            'hospname' => 'ชื่อหน่วยงาน',
            'hospcode' => 'รหัสหน่วยงาน',
            'provcode' => 'รหัสจังหวัด',
            'cchangwat.provname' => 'จังหวัด', // เพิ่ม label สำหรับชื่อจังหวัด
            'created_at' => 'วันที่สร้าง',
            'updated_at' => 'วันที่แก้ไข',
            'created_by' => 'ผู้บันทึก',
            'updated_by' => 'ผู้แก้ไข',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->hospname = Yii::$app->user->identity->hospname;
                $this->hospcode = Yii::$app->user->identity->hospcode;
                $this->provcode = Yii::$app->user->identity->provcode;
            }
            return true;
        }
        return false;
    }
}