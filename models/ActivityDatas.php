<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity_datas".
 *
 * @property int $id
 * @property string|null $hospcode
 * @property string|null $activity_date
 * @property int|null $activity_id
 * @property string|null $content
 * @property string|null $json_upload_file
 * @property string|null $create_date
 * @property int|null $create_by_user_id
 */
class ActivityDatas extends \yii\db\ActiveRecord
{
    public $des;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity_datas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_date', 'json_upload_file', 'create_date'], 'safe'],
            [['activity_id', 'create_by_user_id'], 'integer'],
            [['content'], 'string'],
            [['hospcode'], 'string', 'max' => 5],
            [['activity_date','activity_id'],'required'],
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
            'activity_date' => 'Activity Date',
            'activity_id' => 'Activity ID',
            'content' => 'Content',
            'json_upload_file' => 'Json Upload File',
            'create_date' => 'Create Date',
            'create_by_user_id' => 'Create By User ID',
        ];
    }

    public function getChospital(){
        return $this->hasOne(Chospital::className(),['hoscode'=>'hospcode']);
    }

    public function getActivity(){
        return $this->hasOne(CActivity::className(),['id'=>'activity_id']);
    }
}
