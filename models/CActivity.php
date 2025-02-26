<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "c_activity".
 *
 * @property int $id
 * @property string|null $des
 */
class CActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'c_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'des' => 'Des',
        ];
    }
}
