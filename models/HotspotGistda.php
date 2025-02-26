<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotspot_gistda".
 *
 * @property string $id
 * @property float $longitude
 * @property float $latitude
 * @property string $linkgmap
 * @property string $confidence
 * @property string $lu_hp_name
 * @property string $lu_name
 * @property string $province_TH
 * @property string $amphur_TH
 * @property string $tambon_TH
 * @property string $pv_code
 * @property string $ap_code
 * @property string $tb_code
 * @property string $addr_code
 * @property string $th_date
 * @property string $th_time
 */
class HotspotGistda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotspot_gistda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'longitude', 'latitude', 'linkgmap', 'confidence', 'lu_hp_name', 'lu_name', 'province_TH', 'amphur_TH', 'tambon_TH', 'pv_code', 'ap_code', 'tb_code', 'addr_code', 'th_date', 'th_time'], 'required'],
            [['longitude', 'latitude'], 'number'],
            [['th_date', 'th_time'], 'safe'],
            [['id', 'linkgmap', 'confidence', 'lu_hp_name', 'lu_name', 'province_TH', 'amphur_TH', 'tambon_TH', 'pv_code', 'ap_code', 'tb_code', 'addr_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'linkgmap' => 'Link to Google Maps',
            'confidence' => 'Confidence',
            'lu_hp_name' => 'LU HP Name',
            'lu_name' => 'LU Name',
            'province_TH' => 'Province (TH)',
            'amphur_TH' => 'Amphur (TH)',
            'tambon_TH' => 'Tambon (TH)',
            'pv_code' => 'Province Code',
            'ap_code' => 'Amphur Code',
            'tb_code' => 'Tambon Code',
            'addr_code' => 'Address Code',
            'th_date' => 'Thai Date',
            'th_time' => 'Thai Time',
        ];
    }
}
