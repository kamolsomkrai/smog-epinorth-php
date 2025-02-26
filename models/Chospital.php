<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chospital".
 *
 * @property string $hoscode
 * @property string|null $hosname
 * @property string|null $hostype
 * @property string|null $address
 * @property string|null $road
 * @property string|null $mu
 * @property string|null $subdistcode
 * @property string|null $distcode
 * @property string|null $provcode
 * @property string|null $postcode
 * @property string|null $hoscodenew
 * @property string|null $bed จำนวนเตียง
 * @property string|null $level_service ระดับการบริการ
 * @property string|null $bedhos
 * @property int|null $hdc_regist
 * @property string|null $dep
 * @property string|null $hmain_sent
 * @property string|null $hosname2
 * @property string|null $service_plan
 * @property int|null $level
 */
class Chospital extends \yii\db\ActiveRecord
{
    public $provname,$wk1
    ,$wk2
    ,$wk3
    ,$wk4
    ,$wk5
    ,$wk6
    ,$wk7
    ,$wk8
    ,$wk9
    ,$wk10
    ,$wk11
    ,$wk12
    ,$wk13
    ,$wk14
    ,$wk15
    ,$wk16
    ,$wk17
    ,$wk18
    ,$wk19
    ,$wk20
    ,$wk21
    ,$wk22
    ,$wk23
    ,$wk24
    ,$wk25
    ,$wk26
    ,$wk27
    ,$wk28
    ,$wk29
    ,$wk30
    ,$wk31
    ,$wk32
    ,$wk33
    ,$wk34
    ,$wk35
    ,$wk36
    ,$wk37
    ,$wk38
    ,$wk39
    ,$wk40
    ,$wk41
    ,$wk42
    ,$wk43
    ,$wk44
    ,$wk45
    ,$wk46
    ,$wk47
    ,$wk48
    ,$wk49
    ,$wk50
    ,$wk51
    ,$wk52
    ,$wk53,$d1
    ,$d2
    ,$d3
    ,$d4
    ,$d5
    ,$d6
    ,$d7
    ,$d8
    ,$d9
    ,$d10
    ,$d11
    ,$d12
    ,$d13
    ,$d14
    ,$d15
    ,$d16
    ,$d17
    ,$d18
    ,$d19
    ,$d20
    ,$d21
    ,$d22
    ,$d23
    ,$d24
    ,$d25
    ,$d26
    ,$d27
    ,$d28
    ,$d29
    ,$d30
    ,$d31;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chospital';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoscode'], 'required'],
            [['hdc_regist', 'level'], 'integer'],
            [['hoscode', 'postcode', 'bed', 'bedhos', 'dep', 'hmain_sent'], 'string', 'max' => 5],
            [['hosname', 'level_service', 'hosname2'], 'string', 'max' => 255],
            [['hostype', 'mu', 'subdistcode', 'distcode', 'provcode', 'service_plan'], 'string', 'max' => 2],
            [['address', 'road'], 'string', 'max' => 50],
            [['hoscodenew'], 'string', 'max' => 9],
            [['hoscode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hoscode' => 'Hoscode',
            'hosname' => 'Hosname',
            'hostype' => 'Hostype',
            'address' => 'Address',
            'road' => 'Road',
            'mu' => 'Mu',
            'subdistcode' => 'Subdistcode',
            'distcode' => 'Distcode',
            'provcode' => 'Provcode',
            'postcode' => 'Postcode',
            'hoscodenew' => 'Hoscodenew',
            'bed' => 'Bed',
            'level_service' => 'Level Service',
            'bedhos' => 'Bedhos',
            'hdc_regist' => 'Hdc Regist',
            'dep' => 'Dep',
            'hmain_sent' => 'Hmain Sent',
            'hosname2' => 'Hosname2',
            'service_plan' => 'Service Plan',
            'level' => 'Level',
        ];
    }
}
