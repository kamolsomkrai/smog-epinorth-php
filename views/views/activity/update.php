<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ActivityDatas $model */

$this->title = 'Update Activity Datas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activity Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activity-datas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
