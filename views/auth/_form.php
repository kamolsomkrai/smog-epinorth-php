<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Token $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="token-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hospcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token')->textarea(['rows'=>3]) ?>

    <?= $form->field($model, 'exp')->textInput() ?>

    <?= $form->field($model, 'create_date_time')->textInput() ?>

    <?= $form->field($model, 'create_by_user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
