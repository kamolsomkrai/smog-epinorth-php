<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ActivityDatas $model */

$this->title = 'เพิ่มข้อมูล';
$this->params['breadcrumbs'][] = ['label' => 'กิจกรรมหมอกควัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-datas-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'upload' => $upload,
    ]) ?>

</div>
