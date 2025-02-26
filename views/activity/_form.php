<?php

use app\models\CActivity;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
/** @var yii\web\View $this */
/** @var app\models\ActivityDatas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="activity-datas-form">

    <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
    ]); ?>

    <?= $form->field($model, 'activity_date')->widget(DatePicker::className(),[
            'language'=>'th',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-m-d'
            ]
    ])->label('วันที่') ?>

    <?= $form->field($model, 'activity_id')->widget(Select2::className(),[
            'data' => ArrayHelper::map(CActivity::find()->asArray()->all(),'id','des')
    ]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6])->label('รายละเอียด') ?>

    <div class="form-group mb-3">
        <label class="form-label">เอกสาร</label>
        <?= FileInput::widget([
                'model' => $upload,
                'name' => 'documents[]',
                'options' => [
                    'multiple'=>true,
                ],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['docx','doc','xlsx','xls','pdf'],
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
        ])?>
    </div>

    <div class="form-group mb-3">
        <label class="form-label">รูปภาพ</label>
        <?= FileInput::widget([
            'model' => $upload,
            'name' => 'images[]',
            'options' => [
                'multiple'=>true,
                'accept' => 'image/*'
            ],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ]
        ])?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
