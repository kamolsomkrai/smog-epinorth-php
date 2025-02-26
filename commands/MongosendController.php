<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Mongo;
use app\models\Report1Day;
use app\models\SmogImport;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MongosendController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        ignore_user_abort(true);
        ini_set('max_execution_time', 0);
        ini_set("memory_limit", "-1");

        $model = Report1Day::find()->groupBy('hoscode,mmmm')->orderBy('hoscode')->all();

        foreach ($model as $row) {
            $smogImport = SmogImport::find()->where(['hospcode' => $row->hoscode, 'month(date_serv)' => $row->mmmm])->asArray()->all();


            foreach ($smogImport as $arr) {
                $checkModel = Mongo::find()->getCollection()->findOne([
                    'hospcode' => $arr['hospcode'],
                    'pid' => $arr['pid'],
                    'seq' => $arr['seq'],
                    'date_serv' => $arr['date_serv'],
                    'diagcode' => $arr['diagcode'],
                ]);
                if (strlen($arr['hospcode']) == 5)
                    if (empty($checkModel)) {
                        Mongo::find()->getCollection()->insert($arr);
                    }
            }
            $hospcode = $row->hoscode;
            $sql = "insert into send(hospcode) value('$hospcode')";
            \Yii::$app->db->createCommand($sql)->execute();
        }
    }
}
