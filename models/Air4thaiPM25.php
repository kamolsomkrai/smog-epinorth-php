<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "air4thai_pm25".
 *
 * @property string $stationID
 * @property string $nameTH
 * @property string $nameEN
 * @property string $areaTH
 * @property string $areaEN
 * @property string $province_EN
 * @property string $amphur_EN
 * @property string $province_TH
 * @property string $amphur_TH
 * @property string $tambon_TH
 * @property float $latitude
 * @property float $longitude
 * @property string $api_date
 * @property string $api_time
 * @property string $PM25_color_id
 * @property int $PM25_aqi
 * @property float $PM25_value
 * @property string $record_date
 * @property string $record_time
 */
class Air4thaiPm25 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'air4thai_pm25';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stationID', 'nameTH', 'nameEN', 'areaTH', 'areaEN', 'province_EN', 'amphur_EN', 'province_TH', 'amphur_TH', 'tambon_TH', 'latitude', 'longitude', 'api_date', 'api_time', 'PM25_color_id', 'PM25_aqi', 'PM25_value', 'record_date', 'record_time'], 'required'],
            [['latitude', 'longitude', 'PM25_value'], 'number'],
            [['api_date', 'api_time', 'record_date', 'record_time'], 'safe'],
            [['PM25_aqi'], 'integer'],
            [['stationID', 'nameTH', 'nameEN', 'areaTH', 'areaEN', 'province_EN', 'amphur_EN', 'province_TH', 'amphur_TH', 'tambon_TH', 'PM25_color_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stationID' => 'Station ID',
            'nameTH' => 'Name (TH)',
            'nameEN' => 'Name (EN)',
            'areaTH' => 'Area (TH)',
            'areaEN' => 'Area (EN)',
            'province_EN' => 'Province (EN)',
            'amphur_EN' => 'Amphur (EN)',
            'province_TH' => 'Province (TH)',
            'amphur_TH' => 'Amphur (TH)',
            'tambon_TH' => 'Tambon (TH)',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'api_date' => 'API Date',
            'api_time' => 'API Time',
            'PM25_color_id' => 'PM2.5 Color ID',
            'PM25_aqi' => 'PM2.5 AQI',
            'PM25_value' => 'PM2.5 Value',
            'record_date' => 'Record Date',
            'record_time' => 'Record Time',
        ];
    }
}
