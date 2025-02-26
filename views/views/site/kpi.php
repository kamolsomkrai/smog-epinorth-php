<?php
/* @var $this \yii\web\View */
/* @var $dataprovider \yii\data\ArrayDataProvider */
/* @var $model \app\models\CoKpi|array|null|\yii\db\ActiveRecord */

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'KPI';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->kpi_name;

// ตรวจสอบว่ามีข้อมูลใน dataprovider หรือไม่
$models = $dataprovider->getModels();
$cols = !empty($models) ? array_keys($models[0]) : [];
$items = [];
foreach ($cols as $col) {
    $items[] = [
        'attribute' => "$col",
        'noWrap' => true,
    ];
}
?>

<div class="site-kpi">
    <!-- ฟอร์มค้นหาเพื่อกรองข้อมูลตามปี -->
    <div class="year-search" style="margin-bottom: 20px;">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['kpi', 'kpi_id' => $model->kpi_id], // URL ไปที่ actionKpi (ปรับตามความเหมาะสม)
        ]); ?>
            <?= Html::label('กรองข้อมูล ปี:', 'year') ?>
            <?= Html::textInput('year', Yii::$app->request->get('year'), [
                    'class' => 'form-control',
                    'style' => 'width:200px; display:inline-block; margin-right:10px;'
            ]) ?>
            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>

    <?= GridView::widget([
        'responsiveWrap' => false,
        'containerOptions' => ['style' => 'overflow: auto;font-size: 12px;'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'dataProvider' => $dataprovider,
        'columns' => $items,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => $model->kpi_name,
            'footer' => false,
            'after' => false,
        ],
        'hover' => true,
        'toolbar' => ['{export}'],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'Save as Excel'],
        ],
        'summary' => false,
    ]) ?>
</div>
