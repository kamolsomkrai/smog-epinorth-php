<?php



/* @var $this \yii\web\View */
/* @var $dataprovider \yii\data\ArrayDataProvider */
/* @var $model \app\models\CoKpi|array|null|\yii\db\ActiveRecord */

use kartik\grid\GridView;


$this->title = 'KPI';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->kpi_name;


$cols = array_keys($dataprovider->models[0]);
$items = [];
foreach($cols as $col){
    $items[] = [
            'attribute'=>"$col",
            'noWrap'=> true,

    ];
}
?>

<div class="site-kpi">
    <?= GridView::widget([
        'responsiveWrap' => false,
        'containerOptions'=>['style'=>'overflow: auto;font-size: 12px;'],
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'dataProvider' => $dataprovider,
        'columns' => $items,
        'panel'=>[
            'type'=>GridView::TYPE_INFO,
            'heading'=>$model->kpi_name,
            'footer'=>false,
//            'before'=>false,
            'after'=>false,
        ],
        'hover'=>true,
        'toolbar'=>[
            '{export}',
        ],
        'exportConfig' => [
            GridView::EXCEL => ['label' => 'Save as Excel'],
        ],
        'summary'=>false,
    ])?>
</div>
