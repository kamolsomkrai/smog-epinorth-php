<?php
/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Html;

$this->title = 'กิจกรรมหมอกควัน';
$this->params['breadcrumbs'][] = $this->title;

// Define the list of provinces from the given JSON data
$provinces = [
    50 => 'เชียงใหม่',
    51 => 'ลำพูน',
    52 => 'ลำปาง',
    54 => 'แพร่',
    55 => 'น่าน',
    56 => 'พะเยา',
    57 => 'เชียงราย',
    58 => 'แม่ฮ่องสอน'
];

$selectedProvince = Yii::$app->request->get('province');
?>
<style>
    .site-activity {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .site-activity h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #007bff;
        text-align: center;
    }

    .site-activity .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: all 0.3s ease;
    }

    .site-activity .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .kv-grid-table th,
    .kv-grid-table td {
        vertical-align: middle;
        text-align: center;
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

    .kv-panel-before, .kv-panel-after {
        border: none;
        padding: 0;
    }

    .kv-toolbar {
        padding: 0 15px;
    }

    .text-end {
        text-align: end;
    }

    /* Truncate long text and show ellipsis */
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
        max-width: 250px; /* Adjust the width as needed */
    }
</style>

<div class="site-activity">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Province filter dropdown -->
    <div class="row">
        <div class="col-md-4">
            <?= Html::beginForm(['index'], 'get') ?>
            <?= Select2::widget([
                'name' => 'province',
                'data' => $provinces,
                'value' => $selectedProvince,
                'options' => [
                    'placeholder' => 'Select a province...',
                    'onchange' => 'this.form.submit()',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]) ?>
            <?= Html::endForm() ?>
        </div>
        <div class="col-md-8 text-end" style="padding-bottom: 5px">
            <?= Html::a('เพิ่มข้อมูลกิจกรรม', ['activity/create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'containerOptions' => ['style' => 'overflow: auto; font-size: 14px;'],
        'columns' => [
            ['attribute' => 'activity_date', 'label' => 'วันที่', 'noWrap' => true],
            [
                'attribute' => 'chospital.hosname',
                'label' => 'หน่วยบริการ',
                'noWrap' => true,
            ],
            ['attribute' => 'des', 'label' => 'ประเภทกิจกรรม', 'noWrap' => true],
            [
                'attribute' => 'content',
                'label' => 'รายละเอียด',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(Html::tag('span', $model->content, ['class' => 'truncate']), ['activity/view', 'id' => md5($model->id)]);
                },
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'visible' => !Yii::$app->user->isGuest,
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => "กิจกรรมหมอกควัน",
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
