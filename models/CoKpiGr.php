<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "co_kpi_gr".
 *
 * @property int $group_report
 * @property string|null $des
 * @property int|null $show
 */
class CoKpiGr extends \yii\db\ActiveRecord
{
    public  $kpi_name, $kpi_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'co_kpi_gr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_report'], 'required'],
            [['group_report', 'show'], 'integer'],
            [['des'], 'string', 'max' => 255],
            [['group_report'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_report' => 'Group Report',
            'des' => 'Des',
            'show' => 'Show',
        ];
    }
}
