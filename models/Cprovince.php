<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cprovince".
 *
 * @property string $provcode
 * @property string|null $provname
 * @property string|null $zone
 * @property float|null $region
 * @property int|null $pop
 */
class Cprovince extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cprovince';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provcode'], 'required'],
            [['region'], 'number'],
            [['pop'], 'integer'],
            [['provcode', 'zone'], 'string', 'max' => 2],
            [['provname'], 'string', 'max' => 25],
            [['provcode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'provcode' => 'Provcode',
            'provname' => 'Provname',
            'zone' => 'Zone',
            'region' => 'Region',
            'pop' => 'Pop',
        ];
    }
}
