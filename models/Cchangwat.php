<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cchangwat".
 *
 * @property string $provcode
 * @property string|null $provname
 * @property string|null $zone
 * @property float|null $region
 * @property int|null $pop
 * @property int|null $hosp_all
 * @property string|null $provgen
 */
class Cchangwat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cchangwat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provcode'], 'required'],
            [['region'], 'number'],
            [['pop', 'hosp_all'], 'integer'],
            [['provcode', 'zone'], 'string', 'max' => 2],
            [['provname'], 'string', 'max' => 25],
            [['provgen'], 'string', 'max' => 255],
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
            'hosp_all' => 'Hosp All',
            'provgen' => 'Provgen',
        ];
    }
}
