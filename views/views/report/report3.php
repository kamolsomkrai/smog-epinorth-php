<?php

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

use app\models\Cprovince;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$year = date('Y');

for ($i = $year - 5; $i <= $year; $i++) {
    $y[$i + 543] = $i + 543;
}

$this->title = 'รายงาน';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'รายงานจำนวนผู้ป่วยนอกรายสัปดาห์จำแนกตามโรงพยาบาลที่เฝ้าระวัง';

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

$items = [
    [
        'value' => function($model) {
            return "<h4>จังหวัด " . $model->provname . "</h4>";
        },
        'group' => true,
        'groupedRow' => true,
        'format' => 'raw',
    ],
    [
        'value' => function($model) {
            return $model->hosname;
        },
        'noWrap' => true,
        'options' => ['class' => 'kv-hoscode'],
    ],
];

if (!Yii::$app->request->get('month')) {
    // แสดงผลแบบรายสัปดาห์
    for ($i = 1; $i <= 53; $i++) {
        $items[] = [
            'attribute' => "wk$i",
            'hAlign'    => GridView::ALIGN_CENTER,
            'class'     => '\kartik\grid\BooleanColumn'
        ];
    }
} else {
    // แสดงผลแบบรายวัน
    $month    = Yii::$app->request->get('month');
    $yearBE   = Yii::$app->request->get('year'); // รับเป็น พ.ศ.
    $yearCE   = $yearBE - 543; // แปลงเป็น ค.ศ.
    $dayTotal = date('t', strtotime("$yearCE-$month-01")); // คำนวณจำนวนวันในเดือน

    for ($i = 1; $i <= $dayTotal; $i++) {
        $items[] = [
            'attribute' => "d$i",
            'header'    => "$i",
            'hAlign'    => GridView::ALIGN_CENTER,
            'class'     => '\kartik\grid\BooleanColumn'
        ];
    }
}
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
        /* padding: 0.5rem; */
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

<div class="report-search">
    <form method="get" id="search" style="margin-bottom: 20px">
        <input type="hidden" name="r" value="<?= Yii::$app->request->get('r') ?>">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-xs-12">
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
                            $("#search").submit();
                        }',
                    ],
                ]) ?>
            </div>
        </div>
    </form>
</div>

<div class="report-report1">
    <?= GridView::widget([
        'responsiveWrap' => false,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'containerOptions' => ['style' => 'overflow: auto'],
        'tableOptions' => [
            'class' => 'table table-bordered table-hover table-sm'
        ],
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'dataProvider' => $dataProvider,
        'columns' => $items,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => "ตารางที่ 3 การรายงานจำนวนผู้ป่วยนอกรายสัปดาห์ จำแนกตามโรงพยาบาลที่เฝ้าระวัง",
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
