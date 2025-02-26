<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report1_week".
 *
 * @property int|null $yyyy
 * @property int|null $mmmm
 * @property string $hoscode
 * @property string|null $hosname
 * @property string|null $provcode
 * @property string $groupcode
 * @property string|null $groupname
 * @property float|null $wk1
 * @property float|null $wk2
 * @property float|null $wk3
 * @property float|null $wk4
 * @property float|null $wk5
 * @property float|null $wk6
 * @property float|null $wk7
 * @property float|null $wk8
 * @property float|null $wk9
 * @property float|null $wk10
 * @property float|null $wk11
 * @property float|null $wk12
 * @property float|null $wk13
 * @property float|null $wk14
 * @property float|null $wk15
 * @property float|null $wk16
 * @property float|null $wk17
 * @property float|null $wk18
 * @property float|null $wk19
 * @property float|null $wk20
 * @property float|null $wk21
 * @property float|null $wk22
 * @property float|null $wk23
 * @property float|null $wk24
 * @property float|null $wk25
 * @property float|null $wk26
 * @property float|null $wk27
 * @property float|null $wk28
 * @property float|null $wk29
 * @property float|null $wk30
 * @property float|null $wk31
 * @property float|null $wk32
 * @property float|null $wk33
 * @property float|null $wk34
 * @property float|null $wk35
 * @property float|null $wk36
 * @property float|null $wk37
 * @property float|null $wk38
 * @property float|null $wk39
 * @property float|null $wk40
 * @property float|null $wk41
 * @property float|null $wk42
 * @property float|null $wk43
 * @property float|null $wk44
 * @property float|null $wk45
 * @property float|null $wk46
 * @property float|null $wk47
 * @property float|null $wk48
 * @property float|null $wk49
 * @property float|null $wk50
 * @property float|null $wk51
 * @property float|null $wk52
 * @property float|null $wk53
 */
class Report1Week extends \yii\db\ActiveRecord
{
    public  $provname;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report1_week';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['yyyy', 'mmmm'], 'integer'],
            [['wk1', 'wk2', 'wk3', 'wk4', 'wk5', 'wk6', 'wk7', 'wk8', 'wk9', 'wk10', 'wk11', 'wk12', 'wk13', 'wk14', 'wk15', 'wk16', 'wk17', 'wk18', 'wk19', 'wk20', 'wk21', 'wk22', 'wk23', 'wk24', 'wk25', 'wk26', 'wk27', 'wk28', 'wk29', 'wk30', 'wk31', 'wk32', 'wk33', 'wk34', 'wk35', 'wk36', 'wk37', 'wk38', 'wk39', 'wk40', 'wk41', 'wk42', 'wk43', 'wk44', 'wk45', 'wk46', 'wk47', 'wk48', 'wk49', 'wk50', 'wk51', 'wk52', 'wk53'], 'number'],
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
            'wk1' => 'Wk1',
            'wk2' => 'Wk2',
            'wk3' => 'Wk3',
            'wk4' => 'Wk4',
            'wk5' => 'Wk5',
            'wk6' => 'Wk6',
            'wk7' => 'Wk7',
            'wk8' => 'Wk8',
            'wk9' => 'Wk9',
            'wk10' => 'Wk10',
            'wk11' => 'Wk11',
            'wk12' => 'Wk12',
            'wk13' => 'Wk13',
            'wk14' => 'Wk14',
            'wk15' => 'Wk15',
            'wk16' => 'Wk16',
            'wk17' => 'Wk17',
            'wk18' => 'Wk18',
            'wk19' => 'Wk19',
            'wk20' => 'Wk20',
            'wk21' => 'Wk21',
            'wk22' => 'Wk22',
            'wk23' => 'Wk23',
            'wk24' => 'Wk24',
            'wk25' => 'Wk25',
            'wk26' => 'Wk26',
            'wk27' => 'Wk27',
            'wk28' => 'Wk28',
            'wk29' => 'Wk29',
            'wk30' => 'Wk30',
            'wk31' => 'Wk31',
            'wk32' => 'Wk32',
            'wk33' => 'Wk33',
            'wk34' => 'Wk34',
            'wk35' => 'Wk35',
            'wk36' => 'Wk36',
            'wk37' => 'Wk37',
            'wk38' => 'Wk38',
            'wk39' => 'Wk39',
            'wk40' => 'Wk40',
            'wk41' => 'Wk41',
            'wk42' => 'Wk42',
            'wk43' => 'Wk43',
            'wk44' => 'Wk44',
            'wk45' => 'Wk45',
            'wk46' => 'Wk46',
            'wk47' => 'Wk47',
            'wk48' => 'Wk48',
            'wk49' => 'Wk49',
            'wk50' => 'Wk50',
            'wk51' => 'Wk51',
            'wk52' => 'Wk52',
            'wk53' => 'Wk53',
        ];
    }

    public static function primaryKey()
    {
      return ['hoscode'];
    }

    public function getCprovince(){
        return $this->hasOne(Cprovince::className(),['provcode'=>'provcode']);
    }
}
