<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "token".
 *
 * @property int $id
 * @property string|null $hospcode
 * @property string|null $token
 * @property string|null $exp
 * @property string|null $create_date_time
 * @property int|null $create_by_user_id
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token'], 'string'],
            [['exp', 'create_date_time'], 'safe'],
            [['create_by_user_id'], 'integer'],
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
            'token' => 'Token',
            'exp' => 'Exp',
            'create_date_time' => 'Create Date Time',
            'create_by_user_id' => 'Create By User ID',
        ];
    }
}
