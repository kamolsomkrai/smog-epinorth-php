<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "co_kpi".
 *
 * @property string $kpi_id
 * @property string|null $kpi_name
 * @property string|null $sql_level1
 * @property string|null $std1
 * @property string|null $sql_level2
 * @property string|null $std2
 * @property string|null $sql_level3
 * @property string|null $std3
 * @property int|null $group_report
 * @property string|null $sql_exchang
 * @property string|null $CHK
 * @property bool|null $NEW
 * @property string|null $note
 * @property int|null $chart_id
 */
class CoKpi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'co_kpi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kpi_id'], 'required'],
            [['sql_level1', 'sql_level2', 'sql_level3', 'sql_exchang', 'note'], 'string'],
            [['group_report', 'chart_id'], 'integer'],
            [['NEW'], 'boolean'],
            [['kpi_id'], 'string', 'max' => 100],
            [['kpi_name'], 'string', 'max' => 255],
            [['std1', 'std2', 'std3'], 'string', 'max' => 50],
            [['CHK'], 'string', 'max' => 1],
            [['kpi_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kpi_id' => 'Kpi ID',
            'kpi_name' => 'Kpi Name',
            'sql_level1' => 'Sql Level1',
            'std1' => 'Std1',
            'sql_level2' => 'Sql Level2',
            'std2' => 'Std2',
            'sql_level3' => 'Sql Level3',
            'std3' => 'Std3',
            'group_report' => 'Group Report',
            'sql_exchang' => 'Sql Exchang',
            'CHK' => 'Chk',
            'NEW' => 'New',
            'note' => 'Note',
            'chart_id' => 'Chart ID',
        ];
    }
}
