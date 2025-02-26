<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0"><i class="fas fa-plus-circle"></i> เพิ่มเวชภัณฑ์</h4>
    </div>
    
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'needs-validation', 'novalidate' => true],
        ]); ?>

        <div class="mb-3">
            <?= $form->field($model, 'name', [
                'inputOptions' => ['class' => 'form-control', 'maxlength' => true],
            ])->textInput()->label('ชื่อเวชภัณฑ์ <span class="text-danger">*</span>', ['class' => 'form-label']) ?>
        </div>
        
        <div class="mb-3">
            <?= $form->field($model, 'type', [
                'inputOptions' => ['class' => 'form-select'],
            ])->dropDownList([
                'ยา' => 'ยา',
                'วัสดุ' => 'วัสดุ',
                'น้ำยา' => 'น้ำยา',
            ], ['prompt' => 'เลือกประเภท'])->label('ประเภท <span class="text-danger">*</span>', ['class' => 'form-label']) ?>
        </div>
        
        <div class="mb-3">
            <?= $form->field($model, 'quantity', [
                'inputOptions' => ['class' => 'form-control', 'type' => 'number', 'min' => 0],
            ])->textInput()->label('จำนวน <span class="text-danger">*</span>', ['class' => 'form-label']) ?>
        </div>

        <div class="d-flex justify-content-between">
            <?= Html::submitButton('<i class="fas fa-save"></i> บันทึก', [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'คุณต้องการบันทึกข้อมูลใช่หรือไม่?',
                ],
            ]) ?>
            <?= Html::a('<i class="fas fa-arrow-left"></i> ยกเลิก', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
