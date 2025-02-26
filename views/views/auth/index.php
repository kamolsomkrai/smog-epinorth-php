<?php

use app\models\ApiImports;
use app\models\Token;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tokens';
$this->params['breadcrumbs'][] = $this->title;

$JS = <<< JS
    $('[data-tooltip="tooltip"]').tooltip();
    $(document).on('click','a.copy-text',function(){
        var temp  = $("<input>");
        var url = $(this).attr('token');
        $("body").append(temp);
        temp.val(url).select();
        document.execCommand('copy');
        temp.remove();
        return false;
    });
JS;
$this->registerJs($JS);
?>

<style>
    .token-index {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .token-index h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #007bff;
        text-align: center;
    }

    .token-index .btn {
        margin-right: 10px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .token-index .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .token-index .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .token-index .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .token-index .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .kv-grid-table th,
    .kv-grid-table td {
        vertical-align: middle;
        /* text-align: center; */
    }

    .kv-grid-table th {
        background-color: #f7f9fc;
        color: #333;
        font-weight: bold;
        border-top: none;
        border-bottom: 2px solid #dee2e6;
    }

    .kv-grid-table td {
        border-top: 1px solid #dee2e6;
    }

    .kv-panel {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .kv-panel-heading {
        font-size: 1.25rem;
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border-bottom: 1px solid #dee2e6;
        text-align: center;
    }

    .kv-panel-footer {
        background-color: #f7f9fc;
        border-top: 1px solid #dee2e6;
    }

    .kv-panel-before,
    .kv-panel-after {
        border: none;
        padding: 0;
    }

    .kv-toolbar {
        padding: 0 15px;
    }

    .text-end {
        text-align: end;
    }

    /* Tooltip */
    .tooltip-inner {
        background-color: #333;
        color: #fff;
    }

    .pagination {
        display: flex;
        justify-content: center;
        padding: 20px 0;
    }

    .page-selector {
        display: inline-block;
        margin: 0 10px;
    }

    .page-selector select {
        width: 60px;
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .btn-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        background-color: #f7f7f7;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-container .btn {
        margin-right: 10px;
        transition: all 0.3s ease;
    }

    .btn-container .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-container .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-container .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-container .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

</style>

<div class="token-index">
<div class="btn-container">
        <div>
            <?= Html::a('Create Token', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('End Point', ['endpoint'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->render('search') ?>
    </div>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table-sm table-bordered table-hover',
        ],
        'columns' => [
            [
                'header' => 'Access Token',
                'value' => function($model){
                    $token = substr($model->token, 0, 60) . "...";
                    return Html::a($token, '#', [
                        'class' => 'copy-text',
                        'data-tooltip' => 'tooltip',
                        'data-placement' => 'top',
                        'title' => 'Click to copy',
                        'token' => $model->token,
                        'style' => 'text-decoration: none; color: inherit;',
                    ]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'create_date_time',
                'header' => 'Create Date Time',
                'hAlign' => GridView::ALIGN_CENTER,
                'noWrap' => true,
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => "ติดต่อทดสอบ api line id : bnop20",
            'footer' => false,
            'before' => false,
            'after' => false,
        ],
        'toolbar' => [
            '{export}',
            [
                'content' => Html::tag('div', 'Page size: ' . Select2::widget([
                    'name' => 'pageSize',
                    'value' => Yii::$app->request->get('pageSize', 25),
                    'data' => [10 => 10, 25 => 25, 50 => 50, 100 => 100],
                    'options' => ['class' => 'page-selector'],
                    'pluginEvents' => [
                        'change' => 'function() { 
                            var pageSize = $(this).val();
                            var url = new URL(window.location.href);
                            url.searchParams.set("pageSize", pageSize);
                            window.location.href = url.href;
                        }',
                    ],
                ]), ['class' => 'text-end']),
            ],
        ],
    ]); ?>

    <?php
        $modelApi = ApiImports::find()
            ->select('api_imports.*, chospital.hosname')
            ->innerJoin('chospital', 'chospital.hoscode = api_imports.hospcode')
            ->orderBy(['api_imports.id' => SORT_DESC]);

        if (Yii::$app->request->get('chwcode')) {
            $modelApi->andWhere(['chospital.provcode' => Yii::$app->request->get('chwcode')]);
        }

        $dataProviderApi = new ActiveDataProvider([
            'query' => $modelApi,
            'pagination' => [
                'pageSize' => Yii::$app->request->get('pageSize', 25),
            ],
        ]);

        $method = ['นำเข้า', 'ทดสอบ', 'ลบข้อมูล'];

        echo GridView::widget([
            'dataProvider' => $dataProviderApi,
            'responsiveWrap' => false,
            'containerOptions' => ['style' => 'overflow: auto'],
            'tableOptions' => [
                'class' => 'table-sm table-bordered table-hover',
            ],
            'columns' => [
                [
                    'attribute' => 'hospcode',
                    'header' => 'รหัสหน่วยบริการ',
                ],
                [
                    'attribute' => 'hosname',
                    'header' => 'หน่วยบริการ',
                    'hAlign' => GridView::ALIGN_LEFT,
                    'noWrap' => true,
                ],
                [
                    'header' => 'สถานะ',
                    'hAlign' => GridView::ALIGN_CENTER,
                    'value' => function($model) use ($method) {
                        return $method[$model->method];
                    },
                ],
                [
                    'attribute' => 'rec',
                    'header' => 'จำนวน(record)',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'format' => ['decimal', 0],
                ],
                [
                    'attribute' => 'send_date_time',
                    'header' => 'วันที่ส่งข้อมูล',
                    'hAlign' => GridView::ALIGN_CENTER,
                ],
            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => "API Imports",
                // 'footer' => false,
                'before' => false,
                'after' => false,
            ],
            'toolbar' => [
                '{export}',
                [
                    'content' => Html::tag('div', 'Page size: ' . Select2::widget([
                        'name' => 'pageSize',
                        'value' => Yii::$app->request->get('pageSize', 25),
                        'data' => [10 => 10, 25 => 25, 50 => 50, 100 => 100],
                        'options' => ['class' => 'page-selector'],
                        'pluginEvents' => [
                            'change' => 'function() { 
                                var pageSize = $(this).val();
                                var url = new URL(window.location.href);
                                url.searchParams.set("pageSize", pageSize);
                                window.location.href = url.href;
                            }',
                        ],
                    ]), ['class' => 'text-end']),
                ],
            ],
        ]);
    ?>
</div>
