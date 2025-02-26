<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temp_report1".
 *
 * @property string $hcode
 * @property int|null $yyyy
 * @property string $DATE_SERV
 * @property int|null $wk
 * @property float|null $sex_m
 * @property float|null $sex_f
 * @property float|null $m_a0_4
 * @property float|null $m_a5_14
 * @property float|null $m_a15_34
 * @property float|null $m_a35_59
 * @property float|null $m_a60up
 * @property float|null $f_a0_4
 * @property float|null $f_a5_14
 * @property float|null $f_a15_34
 * @property float|null $f_a35_59
 * @property float|null $f_a60up
 * @property string $groupcode
 */
class TempReport1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temp_report1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hcode', 'DATE_SERV'], 'required'],
            [['yyyy', 'wk'], 'integer'],
            [['sex_m', 'sex_f', 'm_a0_4', 'm_a5_14', 'm_a15_34', 'm_a35_59', 'm_a60up', 'f_a0_4', 'f_a5_14', 'f_a15_34', 'f_a35_59', 'f_a60up'], 'number'],
            [['hcode', 'DATE_SERV'], 'string', 'max' => 255],
            [['groupcode'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hcode' => 'Hcode',
            'yyyy' => 'Yyyy',
            'DATE_SERV' => 'Date Serv',
            'wk' => 'Wk',
            'sex_m' => 'Sex M',
            'sex_f' => 'Sex F',
            'm_a0_4' => 'M A0 4',
            'm_a5_14' => 'M A5 14',
            'm_a15_34' => 'M A15 34',
            'm_a35_59' => 'M A35 59',
            'm_a60up' => 'M A60up',
            'f_a0_4' => 'F A0 4',
            'f_a5_14' => 'F A5 14',
            'f_a15_34' => 'F A15 34',
            'f_a35_59' => 'F A35 59',
            'f_a60up' => 'F A60up',
            'groupcode' => 'Groupcode',
        ];
    }

    public static function  primaryKey()
    {
       return ['hcode'];
    }
}
