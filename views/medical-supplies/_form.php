<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div>
    <?php $form = ActiveForm::begin([
        'id' => 'edit-form',
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList([
        'ยา' => 'ยา',
        'วัสดุ' => 'วัสดุ',
        'น้ำยา' => 'น้ำยา',
    ], ['prompt' => 'เลือกประเภท']) ?>
    <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 0]) ?>

    <div class="form-group text-end">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
