<?php

/** @var \app\components\View $this */

use kartik\grid\GridView;
use yii\helpers\Html;
use yii2fullcalendar\yii2fullcalendar;

$this->title = 'SMOG-Epinorth';
$this->title = 'รายงานหมอกควัน';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .kv-grid-group {
        font-size: 18px;
        font-weight: bold;
        background-color: #f7f9fc;
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
    }

    .kv-grid-table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        background-color: #fff;
        border-collapse: separate;
        border-spacing: 0;
    }

    .kv-grid-table th,
    .kv-grid-table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .kv-grid-table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }

    .kv-grid-table .grouped-row {
        background-color: #f1f1f1;
        font-weight: bold;
    }

    .kv-grid-table .data-cell {
        padding-left: 20px;
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

    .kv-panel-before, .kv-panel-after {
        border: none;
        padding: 0;
    }

    .kv-toolbar {
        padding: 0 15px;
    }
</style>
<div class="site-index">
    <?= GridView::widget([
            'responsiveWrap' => false,
            'containerOptions' => ['style' => 'overflow: auto; font-size: 14px;'],
            'headerRowOptions' => ['style' => 'display:none'],
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'des',
                    'group' => true,
                    'groupedRow' => true,
                    'contentOptions' => ['class' => 'grouped-row'],
                ],
                [
                    'attribute' => 'kpi_name',
                    'contentOptions' => ['class' => 'data-cell'],
                    'format' => 'raw',
                    'value' => function($model) {
                        return Html::a($model->kpi_name, ['site/kpi', 'kpi_id' => $model->kpi_id], ['target' => '_blank']);
                    }
                ],
            ],
            'panel' => [
                'type' => GridView::TYPE_INFO,
                'heading' => "รายงานหมอกควัน",
                'footer' => false,
                'before' => false,
                'after' => false,
                'headingOptions' => ['class' => 'kv-panel-heading'],
                'footerOptions' => ['class' => 'kv-panel-footer'],
            ],
            'hover' => true,
            'toolbar' => false,
            'export' => false,
            'summary' => false,
    ]) ?>
</div>
