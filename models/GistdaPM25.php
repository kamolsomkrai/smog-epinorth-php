<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gistda_pm25".
 *
 * @property int $id
 * @property string $Province
 * @property string $Amphur
 * @property string $Tambon
 * @property string $Addr_ID
 * @property string $Province_ID
 * @property string $Amphur_ID
 * @property string $Tambon_ID
 * @property float $pm25
 * @property float $pm25Avg24hr
 * @property string $color
 * @property string $record_date
 */
class GistdaPm25 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gistda_pm25';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Province', 'Amphur', 'Tambon', 'Addr_ID', 'Province_ID', 'Amphur_ID', 'Tambon_ID', 'pm25', 'pm25Avg24hr', 'color', 'record_date'], 'required'],
            [['pm25', 'pm25Avg24hr'], 'number'],
            [['record_date'], 'safe'],
            [['Province', 'Amphur', 'Tambon', 'Addr_ID', 'Province_ID', 'Amphur_ID', 'Tambon_ID', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Province' => 'Province',
            'Amphur' => 'Amphur',
            'Tambon' => 'Tambon',
            'Addr_ID' => 'Addr ID',
            'Province_ID' => 'Province ID',
            'Amphur_ID' => 'Amphur ID',
            'Tambon_ID' => 'Tambon ID',
            'pm25' => 'PM2.5',
            'pm25Avg24hr' => 'PM2.5 Average 24hr',
            'color' => 'Color',
            'record_date' => 'Record Date',
        ];
    }
}
