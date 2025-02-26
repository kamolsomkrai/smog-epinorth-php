<?php

namespace app\controllers;

use app\models\Chospital;
use app\models\Report1Day;
use app\models\Report1Week;
use app\models\TempReport1;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {


        return $this->render('index');
    }


    public function actionSmog(){

        return $this->render('smog');
    }

    public function actionReport1($year = null, $groupcode = null, $month = null, $provcode = null)
{
    $year = $year == null ? date("Y") + 543 : $year;
    $model = $month != null ? Report1Day::find()
                            : Report1Week::find();

    $model->andFilterWhere(['yyyy' => $year]);
    $model->andFilterWhere(['groupcode' => $groupcode]);
    $model->andFilterWhere(['mmmm' => $month]);
    $model->andFilterWhere(['provcode' => $provcode]);

    $model->orderBy(['provcode' => SORT_ASC, 'hoscode' => SORT_ASC, 'groupcode' => SORT_ASC]);

    $dataProvider = new ActiveDataProvider([
        'query' => $model,
        'sort' => false,
        'pagination' => false,
    ]);

    return $this->render('report1', [
        'dataProvider' => $dataProvider,
    ]);
}

public function actionReport2($year = null, $groupcode = null, $month = null, $hoscode = null, $provcode = null)
{
    $year = $year == null ? date("Y") + 543 : $year;

    if ($month == null) {
        // ถ้าไม่เลือกเดือน ใช้ตาราง Report1Week (รายสัปดาห์)
        for ($i = 1; $i <= 53; $i++) {
            $sql[] = "SUM(wk$i) as wk$i";
        }
        $model = Report1Week::find()
            ->select(['groupcode', 'groupname', 'yyyy'])
            ->addSelect(new Expression(implode(",", $sql)));
    } else {
        // ถ้าเลือกเดือน ใช้ตาราง Report1Day (รายวัน)
        $yearCE = $year - 543; // แปลงปีจาก พ.ศ. เป็น ค.ศ.
        $daysInMonth = function($month, $year) {
            if ($month == 2) {
                return (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) ? 29 : 28;
            }
            return in_array($month, [4, 6, 9, 11]) ? 30 : 31;
        };
        $dayInMonth = $daysInMonth($month, $yearCE);
        for ($i = 1; $i <= $dayInMonth; $i++) {
            $sql[] = "SUM(d$i) as d$i";
        }
        $model = Report1Day::find()
            ->select(['groupcode', 'groupname', 'yyyy'])
            ->addSelect(new Expression(implode(",", $sql)));
    }

    $model->andFilterWhere(['yyyy' => $year]);
    $model->andFilterWhere(['groupcode' => $groupcode]);
    $model->andFilterWhere(['mmmm' => $month]);
    $model->andFilterWhere(['hoscode' => $hoscode]);
    $model->andFilterWhere(['provcode' => $provcode]);

    $model->groupBy(['groupcode', 'groupname', 'yyyy']);

    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => $model,
        'sort' => false,
        'pagination' => false,
    ]);

    return $this->render('report2', [
        'dataProvider' => $dataProvider,
    ]);
}





    public function actionReport3($year = null, $groupcode = null, $month = null,$hoscode = null,$provcode = null){

        $year = $year == null ? date("Y") + 543 : $year;

        $model = $month != null ? Report1Day::find()
                                    ->select('report1_day.*')
                                    ->addSelect('cprovince.provname')
                                    ->innerJoin('cprovince','cprovince.provcode = report1_day.provcode')
                                    ->orderBy(['cprovince.provcode'=>SORT_ASC,'report1_day.hoscode'=>SORT_ASC])
                                :  Report1Week::find()
                                    ->select('report1_week.*')
                                    ->addSelect('cprovince.provname')
                                    ->innerJoin('cprovince','cprovince.provcode = report1_week.provcode')
                                    ->orderBy(['cprovince.provcode'=>SORT_ASC,'report1_week.hoscode'=>SORT_ASC])
        ;
        
        $model->andFilterWhere(['yyyy'=>$year]);
        $model->andFilterWhere(['mmmm'=>$month]);
        $model->andFilterWhere(['hoscode'=>$hoscode]);
        $model->andFilterWhere(['cprovince.provcode'=>$provcode]);
        $model->andFilterWhere(['groupcode'=>'09']);



        $dataProvider = new ActiveDataProvider([
            'query'=>$model,
            'sort'=>false,
            'pagination'=>false,
        ]);

        return $this->render('report3',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionReport4($year = null, $groupcode = null, $month = null, $hoscode = null, $provcode = null, $from_date = null, $to_date = null){
        // Default date range for the current year if not provided
        if ($from_date == null && $to_date == null) {
            $st = date('Y') . "-01-01";
            $en = date('Y') . "-12-31";
        } else {
            $st = $from_date;
            $en = $to_date;
        }
    
        $query = new Query();
        $query->select(new Expression('
                c_report_gr.groupname,
                sum(temp_report1.m_a0_4) as m0004,
                sum(temp_report1.f_a0_4) as f0004,
                sum(temp_report1.m_a5_14) as m0514,
                sum(temp_report1.f_a5_14) as f0514,
                sum(temp_report1.m_a15_34) as m1534,
                sum(temp_report1.f_a15_34) as f1534,
                sum(temp_report1.m_a35_59) as m3559,
                sum(temp_report1.f_a35_59) as f3559,
                sum(temp_report1.m_a60up) as m60,
                sum(temp_report1.f_a60up) as f60,
                sum(temp_report1.sex_m) as mt,
                sum(temp_report1.sex_f) as ft
        '))
        ->from('chospital')
        ->innerJoin('temp_report1', 'temp_report1.hcode = chospital.hoscode')
        ->innerJoin('c_report_gr', 'temp_report1.groupcode = c_report_gr.groupcode')
        ->where(['between', 'temp_report1.date_serv', $st, $en])
        ->groupBy(['c_report_gr.groupcode', 'c_report_gr.groupname'])
        ->orderBy('c_report_gr.groupcode');
    
        if ($provcode) {
            $query->andWhere(['chospital.provcode' => $provcode]);
        }
        if ($hoscode) {
            $query->andWhere(['chospital.hoscode' => $hoscode]);
        }
    
        $result = $query->all();
    
        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
        ]);
    
        return $this->render('report4', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    


    public function actionReport5($year = null, $groupcode = null, $month = null, $hoscode = null, $provcode = null, $from_date = null, $to_date = null){
        // Default date range for the current year if not provided
        if ($from_date == null && $to_date == null) {
            $st = date('Y') . "-01-01";
            $en = date('Y') . "-12-31";
        } else {
            $st = $from_date;
            $en = $to_date;
        }
    
        $query = new Query();
        $query->select(new Expression('
                c_report_gr.groupname,
                sum(temp_report2.m_asthma) as m_asthma,
                sum(temp_report2.f_asthma) as f_asthma,
                sum(temp_report2.m_copd) as m_copd,
                sum(temp_report2.f_copd) as f_copd,
                sum(temp_report2.m_ht) as m_ht,
                sum(temp_report2.f_ht) as f_ht,
                sum(temp_report2.m_dm) as m_dm,
                sum(temp_report2.f_dm) as f_dm,
                sum(temp_report2.f_preg) as f_preg,
                sum(temp_report2.sex_m) as mt,
                sum(temp_report2.sex_f) as ft
        '))
        ->from('chospital')
        ->innerJoin('temp_report2', 'temp_report2.hcode = chospital.hoscode')
        ->innerJoin('c_report_gr', 'temp_report2.groupcode = c_report_gr.groupcode')
        ->where(['between', 'temp_report2.date_serv', $st, $en])
        ->groupBy(['c_report_gr.groupcode', 'c_report_gr.groupname'])
        ->orderBy('c_report_gr.groupcode');
    
        if ($provcode) {
            $query->andWhere(['chospital.provcode' => $provcode]);
        }
        if ($hoscode) {
            $query->andWhere(['chospital.hoscode' => $hoscode]);
        }
    
        $result = $query->all();
    
        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
        ]);
    
        return $this->render('report5', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
}
