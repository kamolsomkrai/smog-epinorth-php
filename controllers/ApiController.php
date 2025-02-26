<?php

namespace app\controllers;
use app\models\Cchangwat;
use app\models\Chospital;
use app\models\Mongo;
use app\models\MongoChospital;
use app\models\Report1Day;
use app\models\Report1Week;
use app\models\SmogImport;
use app\models\Token;
use app\models\Users;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\base\BaseObject;
use yii\db\Exception;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use app\models\ApiImports;

class ApiController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login','json','test'
            ],
        ];

        return $behaviors;
    }

    public function actionTest(){
        ignore_user_abort(true);
        ini_set('max_execution_time', 0);
        ini_set("memory_limit","-1");

        $model = Report1Day::find()->groupBy('hoscode,mmmm')->orderBy('hoscode')->all();

        foreach($model as $row){
//            $smogImport = SmogImport::find()->where(['hospcode'=>$row->hoscode, 'month(date_serv)'=>date('j') ])->asArray()->all();
//            foreach($smogImport as$arr){
//                $checkModel = Mongo::find()->getCollection()->findOne([
//                    'hospcode'=> $arr['hospcode'],
//                    'pid'=> $arr['pid'],
//                    'seq'=> $arr['seq'],
//                    'date_serv'=> $arr['date_serv'],
//                    'diagcode'=> $arr['diagcode'],
//                ]);
//                if( strlen($arr['hospcode']) == 5)
//                if(empty($checkModel)){
//                    Mongo::find()->getCollection()->insert($arr);
//                }
//            }
            $hospcode = $row->hoscode;
            $sql = "insert into send(hospcode) value('$hospcode')";
            \Yii::$app->db->createCommand($sql)->execute();
        }
        return null;
    }
    public function actionJson($table){
        $tables = [
                'USERS',
                'SMOG_IMPORT',
                "TOKEN",
                'SMOG_IMPORT_66_01_04',
                'SMOG_IMPORT_66_01_04_2',
                'SMOG_IMPORT_BACKUP',
        ];

        if( !in_array(strtoupper($table),$tables )){
            $sql = "select * from $table";
            $result = \Yii::$app->db->createCommand($sql)->queryAll();
            return $this->asJson($result);
        }
    }

    public function actionIndex()
    {
        \Yii::$app->response->statusCode = 400;
        return $this->asJson([
            'success' => true,
        ]);
    }

    public function actionSend(){
        if(\Yii::$app->request->isPost){
//            \Yii::info('OK','orders');
            $headers = \Yii::$app->request->headers;
            $accept = $headers->get('Authorization');
            $token = str_replace('Bearer ','',$accept);
            $count = 0;
            $data = \Yii::$app->request->getRawBody();
            $dataArray = json_decode($data);
            $method = $dataArray->method;
            $TOKEN = Token::find()->where(['hospcode'=>\Yii::$app->user->identity->office_code])->orderBy(['id'=>SORT_DESC])->one();

            if($TOKEN->token === $token) {
//                    \Yii::info('OK','orders');

                $datas = ArrayHelper::toArray($dataArray->data, [
                    'app/models/SmogImport' => [
                        'hospcode', 'pid', 'birth', 'sex', 'hn', 'seq', 'date_serv', 'diagtype', 'diagcode', 'clinic', 'provider', 'd_update', 'cid', 'appoint'
                    ],
                ]);
                if(count($datas) == 0){
                    return $this->asJson([
                        'success'=>'false',
                        'message'=>'ไม่มีข้อมูลให้นำเข้า'
                    ]);
                }
                $sql = "replace into smog_import(";
                $col = array_keys($datas[0]);
                $sql .= implode(",", $col);
                $sql .= ") values";

                $values = [];
                foreach ($datas as $rows) {
//                    if (strtoupper($method) != 'TEST'){
//                            $checkModel = Mongo::find()->getCollection()->findOne([
//                                'hospcode'=> $rows['hospcode'],
//                                'pid'=> $rows['pid'],
//                                'seq'=> $rows['seq'],
//                                'date_serv'=> $rows['date_serv'],
//                                'diagcode'=> $rows['diagcode'],
//                            ]);
//
//                            if(empty($checkModel)){
//                                Mongo::find()->getCollection()->insert($rows);
//                            }
//                    }

                    $value = implode("','", $rows);
                    $values[] = "('" . $value . "')";
                }
                $count = count($values);
                $values = implode(",", $values);

                $sql = "$sql $values;";


                if (strtoupper($method) != 'TEST')
                    \Yii::$app->db->createCommand($sql)->execute();

                $modelImport = new ApiImports();
                $modelImport->rec = $count;
                $modelImport->hospcode = \Yii::$app->user->identity->office_code;
                $modelImport->method = strtoupper($method) == 'TEST' ? 1 : 0;
                $modelImport->save();
            }


            return $this->asJson([
                'success'=>true,
            ]);
        }
    }

    public function actionDelete(){

        if(\Yii::$app->request->isPost){
            $headers = \Yii::$app->request->headers;

            $accept = $headers->get('Authorization');
            $token = str_replace('Bearer ','',$accept);

            $hcode = $headers->get('hcode');
            $date_serv = $headers->get('date_serv');
            $TOKEN = Token::find()->where(['hospcode'=>\Yii::$app->user->identity->office_name])->orderBy(['id'=>SORT_DESC])->one();
            if($TOKEN->token === $token) {

                if(\Yii::$app->user->ssj_ok){
                    $allHospcode = Users::find()->where(['provcode'=>\Yii::$app->user->identity->provcode,'ssj_ok'=>false])->asArray()->all();
                    if(!in_array($hcode,$allHospcode)){
                        \Yii::$app->response->statusCode = 400;
                        return $this->asJson([
                            'success'=>false,
                        ]);
                    }
                }

                $result = SmogImport::find()->where(['hospcode' => $hcode, 'date_serv' => $date_serv])->asArray()->all();
                SmogImport::deleteAll(['hospcode' => $hcode, 'date_serv' => $date_serv]);

                $modelImport = new ApiImports();
                $modelImport->rec = count($result);
                $modelImport->hospcode = $hcode;
                $modelImport->method = 2;
                $modelImport->save();
            }

            return $this->asJson([
                'success'=>true,
            ]);
        }

        \Yii::$app->response->statusCode = 400;
        return $this->asJson([
            'success'=> false,
        ]);
    }

    public function actionDeleteall(){
        if(\Yii::$app->request->isPost){
            SmogImport::deleteAll(['hospcode'=>\Yii::$app->user->identity->officename]);

            return $this->asJson([
                'success'=>true,
            ]);
        }

        \Yii::$app->response->statusCode = 400;
        return $this->asJson([
            'success'=>false,
        ]);
    }

    public function actionReport($groupCode = null, $hospcode, $year = null, $chwcode = null, $date, $month=null){

        $year = $year == null ? date("Y") + 543 : $year;
        $model = $month != null ? Report1Day::find()
//                                    ->select(['report1_day.*','cprovince.provname'])
//                                    ->leftJoin('cprovince','cprovince.provcode = report1_day.provcode')
            :  Report1Week::find()
//                    ->select(['report1_week.*','cprovince.provname'])
//                    ->leftJoin('cprovince','cprovince.provcode = report1_week.provcode')
        ;

        if($date != null){
            list($y,$m,$d) = explode('-',$date);
            $d = intval($d);
            $model = Report1Day::find()
                    ->select("yyyy as year,mmmm as month")
                    ->addSelect(new Expression("$d as day"))
                    ->addSelect("d$d as total,groupname")
                    ->where(['yyyy'=>$y,'mmmm'=>intval($m)]);
        }else{
            $model->andFilterWhere(['mmmm'=>$month]);
            $model->andFilterWhere(['yyyy'=>$year]);
        }


        $model->andFilterWhere(['groupcode'=>$groupCode]);
        $model->andFilterWhere(['hoscode'=>$hospcode]);

        $result = $model->orderBy(['provcode'=>SORT_ASC,'hoscode'=>SORT_ASC,'groupcode'=>SORT_ASC])->asArray()->all();

        return $this->asJson($result);

    }
}
