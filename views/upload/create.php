<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Uploadfiles $model */

$this->title = 'Create Uploadfiles';
$this->params['breadcrumbs'][] = ['label' => 'Uploadfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadfiles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
