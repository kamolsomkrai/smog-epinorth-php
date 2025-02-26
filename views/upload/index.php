<?php

use app\models\Uploadfiles;
use yii\helpers\Html;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'นำเข้าข้อมูล';
$this->params['breadcrumbs'][] = $this->title;

$model = new Uploadfiles();
?>
<div class="uploadfiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-container">
        <?= $this->render('_form', ['model' => $model]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            'hospcode',
            [
                'value' => function ($model) {
                    return $model->chospital->hosname;
                },
            ],
            'filename',
            [
                'attribute' => 'rec',
                'header' => 'จำนวน(record)',
                'hAlign' => GridView::ALIGN_RIGHT,
                'format' => ['decimal', 0],
            ],
            [
                'attribute' => 'filesize',
                'hAlign' => GridView::ALIGN_RIGHT,
                'format' => ['decimal', 0],
            ],
            'upload_datetime',
        ],
        'panel' => [
            'type' => GridView::TYPE_SUCCESS,
            'heading' => "<span class='panel-heading-text'>ระบบประมวลผลเวลา 05.00 น. ของทุกวัน</span> <small class='text-bg-danger'>(นำเข้าวันนี้ ดูรายงานได้วันพรุ่งนี้)</small> <br> <small class='text-bg-danger'>!! ไฟล์นำเข้าต้องมีหัวคอลัมน์ด้วยทุกครั้งไม่ฉนั้นจะหายไป 1 Rec !!</small>",
            'footer' => false,
            'before' => false,
            'after' => false,
        ],
        'hover' => true,
        'toolbar' => false,
        'export' => false,
        'summary' => false,
    ]); ?>
</div>
<style>
.uploadfiles-index {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

.uploadfiles-index h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #007bff;
    text-align: center;
    background: linear-gradient(to right, #007bff, #00d4ff);
    -webkit-background-clip: text;
    color: transparent;
}

.form-container {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #f0f5fa;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.kv-grid-table th,
.kv-grid-table td {
    vertical-align: middle;
    text-align: center;
}

.kv-grid-table th {
    background-color: #e3f2fd;
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
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.kv-panel-heading {
    font-size: 1.25rem;
    background-color: #00bfa5;
    color: #fff;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    text-align: center;
    font-weight: bold;
}

.kv-panel-heading .panel-heading-text {
    display: inline-block;
    background: linear-gradient(to right, #ff5722, #ff9800);
    -webkit-background-clip: text;
    color: transparent;
}

.kv-panel-footer {
    background-color: #e3f2fd;
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

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
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
</style>
