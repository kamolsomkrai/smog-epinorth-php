<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report1_day".
 *
 * @property int|null $yyyy
 * @property int|null $mmmm
 * @property string $hoscode
 * @property string|null $hosname
 * @property string|null $provcode
 * @property string $groupcode
 * @property string|null $groupname
 * @property float|null $d1
 * @property float|null $d2
 * @property float|null $d3
 * @property float|null $d4
 * @property float|null $d5
 * @property float|null $d6
 * @property float|null $d7
 * @property float|null $d8
 * @property float|null $d9
 * @property float|null $d10
 * @property float|null $d11
 * @property float|null $d12
 * @property float|null $d13
 * @property float|null $d14
 * @property float|null $d15
 * @property float|null $d16
 * @property float|null $d17
 * @property float|null $d18
 * @property float|null $d19
 * @property float|null $d20
 * @property float|null $d21
 * @property float|null $d22
 * @property float|null $d23
 * @property float|null $d24
 * @property float|null $d25
 * @property float|null $d26
 * @property float|null $d27
 * @property float|null $d28
 * @property float|null $d29
 * @property float|null $d30
 * @property float|null $d31
 */
class Report1Day extends \yii\db\ActiveRecord
{
    public  $provname;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report1_day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['yyyy', 'mmmm'], 'integer'],
            [['d1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20', 'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30', 'd31'], 'number'],
            [['hoscode'], 'string', 'max' => 5],
            [['hosname', 'groupname'], 'string', 'max' => 255],
            [['provcode', 'groupcode'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'yyyy' => 'Yyyy',
            'mmmm' => 'Mmmm',
            'hoscode' => 'Hoscode',
            'hosname' => 'Hosname',
            'provcode' => 'Provcode',
            'groupcode' => 'Groupcode',
            'groupname' => 'Groupname',
            'd1' => 'D1',
            'd2' => 'D2',
            'd3' => 'D3',
            'd4' => 'D4',
            'd5' => 'D5',
            'd6' => 'D6',
            'd7' => 'D7',
            'd8' => 'D8',
            'd9' => 'D9',
            'd10' => 'D10',
            'd11' => 'D11',
            'd12' => 'D12',
            'd13' => 'D13',
            'd14' => 'D14',
            'd15' => 'D15',
            'd16' => 'D16',
            'd17' => 'D17',
            'd18' => 'D18',
            'd19' => 'D19',
            'd20' => 'D20',
            'd21' => 'D21',
            'd22' => 'D22',
            'd23' => 'D23',
            'd24' => 'D24',
            'd25' => 'D25',
            'd26' => 'D26',
            'd27' => 'D27',
            'd28' => 'D28',
            'd29' => 'D29',
            'd30' => 'D30',
            'd31' => 'D31',
        ];
    }

    public static function primaryKey()
    {
        return ["hoscode"];
    }

    public function getGroupname(){
        return "aaa";
    }

    public function getCprovince(){
        return $this->hasOne(Cprovince::className(),['provcode'=>'provcode']);
    }
}
