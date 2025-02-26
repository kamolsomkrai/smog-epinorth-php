<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "smog_import".
 *
 * @property string|null $hospcode
 * @property string|null $pid
 * @property string|null $birth
 * @property string|null $sex
 * @property string|null $hn
 * @property string|null $seq
 * @property string|null $date_serv
 * @property string|null $diagtype
 * @property string|null $diagcode
 * @property string|null $clinic
 * @property string|null $provider
 * @property string|null $d_update
 * @property string|null $cid
 * @property string|null $appoint
 */
class SmogImport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'smog_import';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hospcode', 'pid', 'birth', 'sex', 'hn', 'seq', 'date_serv', 'diagtype', 'diagcode', 'clinic', 'provider', 'd_update', 'cid', 'appoint'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hospcode' => 'Hospcode',
            'pid' => 'Pid',
            'birth' => 'Birth',
            'sex' => 'Sex',
            'hn' => 'Hn',
            'seq' => 'Seq',
            'date_serv' => 'Date Serv',
            'diagtype' => 'Diagtype',
            'diagcode' => 'Diagcode',
            'clinic' => 'Clinic',
            'provider' => 'Provider',
            'd_update' => 'D Update',
            'cid' => 'Cid',
            'appoint' => 'Appoint',
        ];
    }
}
