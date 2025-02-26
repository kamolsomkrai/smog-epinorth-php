<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "c_report_gr".
 *
 * @property string $groupcode
 * @property string|null $groupname
 * @property string|null $icd
 */
class CReportGr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'c_report_gr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupcode'], 'required'],
            [['groupcode'], 'string', 'max' => 2],
            [['groupname', 'icd'], 'string', 'max' => 255],
            [['groupcode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'groupcode' => 'Groupcode',
            'groupname' => 'Groupname',
            'icd' => 'Icd',
        ];
    }
}
