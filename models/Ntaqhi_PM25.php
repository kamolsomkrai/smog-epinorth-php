<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ntaqhi_pm25_avgday".
 *
 * @property int $ntaqhi_id
 * @property string $ntaqhi_name
 * @property string $device
 * @property string $tambol
 * @property string $amphures
 * @property string $city
 * @property float $ntaqhi_lat
 * @property float $ntaqhi_lng
 * @property string $date
 * @property int $pm25_1d
 * @property int $aqhi_1d
 */
class AirQualityData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ntaqhi_pm25_avgday';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ntaqhi_name', 'device', 'tambol', 'amphures', 'city', 'ntaqhi_lat', 'ntaqhi_lng', 'date', 'pm25_1d', 'aqhi_1d'], 'required'],
            [['ntaqhi_lat', 'ntaqhi_lng'], 'number'],
            [['date'], 'safe'],
            [['pm25_1d', 'aqhi_1d'], 'integer'],
            [['ntaqhi_name', 'device', 'tambol', 'amphures', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ntaqhi_id' => 'Ntaqhi ID',
            'ntaqhi_name' => 'Ntaqhi Name',
            'device' => 'Device',
            'tambol' => 'Tambol',
            'amphures' => 'Amphures',
            'city' => 'City',
            'ntaqhi_lat' => 'Ntaqhi Lat',
            'ntaqhi_lng' => 'Ntaqhi Lng',
            'date' => 'Date',
            'pm25_1d' => 'PM2.5 1-Day',
            'aqhi_1d' => 'AQHI 1-Day',
        ];
    }
}
