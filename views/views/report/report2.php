<?php

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

use app\models\Chospital;
use app\models\Cprovince;
use app\models\CReportGr;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'รายงาน';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'ตารางที่ 2 จำนวนรายป่วยผู้ป่วยนอก รายพื้นที่';

$year = date('Y');

for ($i = $year - 5; $i <= $year; $i++) {
    $y[$i + 543] = $i + 543;
}

function days_in_month($month, $year) {
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
}

$items = [
    ['attribute' => 'groupname', 'noWrap' => true],
];

if (!Yii::$app->request->get('month')) {
    for ($i = 1; $i <= 53; $items[] = ['attribute' => "wk$i", 'hAlign' => GridView::ALIGN_RIGHT], $i++);
} else {
    $yearCE = Yii::$app->request->get('year') - 543; // แปลงปีจาก พ.ศ. เป็น ค.ศ.
    $month   = Yii::$app->request->get('month');
    // ใช้ date('t') เพื่อคำนวณจำนวนวันในเดือนแทนฟังก์ชัน cal_days_in_month()
    $dayTotal = date('t', strtotime("$yearCE-$month-01"));
    for ($i = 1; $i <= $dayTotal; $items[] = ['attribute' => "d$i", 'header' => "$i", 'hAlign' => GridView::ALIGN_RIGHT], $i++);
}


$JS = <<<JS
    function numberWithCommas(x) {
        return x.toString().replace(/\\B(?=(\\d{3})+(?!\\d))/g, ",");
    }

    $('.kv-grid-table').find('td').each(function(e){
        let val = parseInt($(this).text()) || false;
        
        if (val > 0) {
            val = numberWithCommas(val);
            $(this).text(val);
        }
    });
JS;

$this->registerJs($JS);
?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f7f9fc;
        color: #333;
    }

    .report-search {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .table-sm {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        background-color: #fff;
    }

    .table-sm th,
    .table-sm td {
        padding: 0.5rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table-sm thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table-sm tbody + tbody {
        border-top: 2px solid #dee2e6;
    }

    .kv-grid-table td[data-col-seq>2] {
        text-align: right;
    }

    .kv-grid-group {
        background-color: #f1f1f1;
        font-weight: bold;
    }

    .kv-panel {
        border: none;
        border-radius: 5px;
        box-shadow: none;
    }

    .kv-panel-heading {
        font-size: 1.25rem;
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .kv-panel-footer {
        background-color: #f7f9fc;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .kv-panel-before {
        border: none;
        padding: 0;
    }

    .kv-panel-after {
        border: none;
        padding: 0;
    }

    .kv-toolbar {
        padding: 0 15px;
    }

    .breadcrumb {
        background-color: #f7f9fc;
        padding: 8px 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }

    .export-button-container {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 10px;
    }

    .export-button-container .btn {
        margin-right: 10px;
    }
</style>

<div class="report-report2">
    <form method="get" id="search" style="margin-bottom: 20px">
        <input type="hidden" name="r" value="<?= Yii::$app->request->get('r') ?>">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-6">
                <label class="form-label">ปี</label>
                <?= Select2::widget([
                    'name' => 'year',
                    'data' => $y,
                    'value' => Yii::$app->request->get('year', date('Y') + 543),
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                            $("#search").submit();
                        }',
                    ],
                ]) ?>
            </div>
            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-6">
                <label class="form-label">เดือน</label>
                <?= Select2::widget([
                    'name' => 'month',
                    'value' => Yii::$app->request->get('month'),
                    'data' => $this->monthName,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => '----ทั้งหมด----'
                    ],
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                            $("#search").submit();
                        }',
                        'select2:clear' => 'function(){
                            $("#search").submit();
                        }',
                    ],
                ]) ?>
            </div>
            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-6">
                <label class="form-label">จังหวัด</label>
                <?= Select2::widget([
                    'name' => 'provcode',
                    'value' => Yii::$app->request->get('provcode'),
                    'data' => ArrayHelper::map(Cprovince::find()->where(['region' => 1])->asArray()->all(), 'provcode', 'provname'),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => '----ทั้งหมด----'
                    ],
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                            $("#search").submit();
                        }',
                        'select2:clear' => 'function(){
                            $("#hoscode").val(null).trigger("change");
                            $("#search").submit();
                        }',
                    ],
                ]) ?>
            </div>
            <!-- <div class="col-lg-4 col-md-4 col-xs-6 col-sm-6">
                <label class="form-label">โรงพยาบาล</label>
                <?= Select2::widget([
                    'id' => 'hoscode',
                    'name' => 'hoscode',
                    'data' => ArrayHelper::map(Chospital::find()->where(['provcode' => Yii::$app->request->get('provcode')])->asArray()->all(), 'hoscode', 'hosname'),
                    'value' => Yii::$app->request->get('hoscode'),
                    'options' => [
                        'placeholder' => '----ทั้งหมด----'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'pluginEvents' => [
                        'select2:select' => 'function(){
                            $("#search").submit();
                        }',
                        'select2:clear' => 'function(){
                            $("#search").submit();
                        }',
                    ],
                ]) ?>
            </div> -->
        </div>
    </form>

    <?= GridView::widget([
        'tableOptions' => [
            'class' => 'table table-bordered table-hover table-sm'
        ],
        'dataProvider' => $dataProvider,
        'columns' => $items,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => "ตารางที่ 2 จำนวนรายป่วยผู้ป่วยนอก รายพื้นที่",
            'footer' => false,
            // 'before' => false,
            'after' => false,
        ],
        'hover' => true,
        'toolbar' => ['{export}',],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'Save as Excel'],
        ],
        'summary' => false,
    ]) ?>
</div>
