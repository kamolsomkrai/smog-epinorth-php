<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api_imports".
 *
 * @property int $id
 * @property string|null $hospcode
 * @property int|null $rec
 * @property string|null $send_date_time
 * @property int $method
 */
class ApiImports extends \yii\db\ActiveRecord
{
    public $hosname,$provname;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_imports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rec'], 'integer'],
            [['method'],'integer'],
            [['send_date_time'], 'safe'],
            [['hospcode'], 'string', 'max' => 5],
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
            'rec' => 'Rec',
            'send_date_time' => 'Send Date Time',
        ];
    }

    public function getChospital(){
        return $this->hasOne(Chospital::className(),['hoscode'=>'hospcode']);
    }
}
