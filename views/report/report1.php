<?php

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

use kartik\grid\GridView;

$JS = <<< JS
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $('.kv-grid-table').find('td').each(function(e){
            let val = parseInt($(this).text()) || false;
            
            if((val > 0) && !($(this).hasClass('kv-grid-group'))){
                val = numberWithCommas(val);
                $(this).text(val);    
            }
            
    });
JS;

$this->registerJs($JS);

$items = [
        [
                'value'=>function($model){
                    return "<h5>จังหวัด ".$model->cprovince->provname."</h5>";
                },
                'format'=>'raw',
                'group'=>true,
                'groupedRow'=>true,
        ],
        [
                'value'=>function($model){
                    return "<h6>".$model->hoscode. " " .$model->hosname."</h6>";
                },
                'format'=>'raw',
                'group'=>true,
                'groupedRow'=>true,
        ],
        [
                'value'=>function($model){
                    return $model->groupname;
                },
            'noWrap'=> true,
        ],
];

if(!Yii::$app->request->get('month')) {
    for ($i = 1; $i <= 53; $i++) {
        $items[] = ['attribute' => "wk$i", 'hAlign' => GridView::ALIGN_RIGHT];
    }
} else {
    $dayTotal = cal_days_in_month(CAL_GREGORIAN, Yii::$app->request->get('month'), Yii::$app->request->get('year') - 543);
    for ($i = 1; $i <= $dayTotal; $i++) {
        $items[] = ['attribute' => "d$i", 'header' => "$i", 'hAlign' => GridView::ALIGN_RIGHT];
    }
}

$this->title = 'รายงาน';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'จำนวนรายป่วย รายโรงพยาบาล';
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
</style>

<div class="report-report1">
    <div>
    <?= $this->render('_search') ?>
    </div>
    <?= GridView::widget([
        'responsiveWrap' => false,
        'containerOptions' => ['style' => 'overflow: auto;font-size: 12px;'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'tableOptions' => [
            'class' => 'table table-bordered table-hover table-sm'
        ],
        'dataProvider' => $dataProvider,
        'columns' => $items,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => "ตารางที่ 1 จำนวนรายป่วย รายโรงพยาบาล",
            'footer' => false,
            // 'before' => false,
            'after' => false,
        ],
        'hover' => true,
        'toolbar' => [
            '{export}',
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'Save as Excel'],
        ],
        'summary' => false,
    ]) ?>
</div>
