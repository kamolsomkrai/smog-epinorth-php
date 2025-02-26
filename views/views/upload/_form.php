<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use kartik\form\ActiveForm;
/** @var yii\web\View $this */
/** @var app\models\Uploadfiles $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uploadfiles-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'uploadedFile')->widget(FileInput::className(),[
        'options' => [
                'multiple'=>false,
        ],
    'pluginOptions' => [
        'showPreview' => false,
        'showCaption' => true,
        'previewFileType'=>'any'
    ]
]) ?>


    <?php ActiveForm::end(); ?>

</div>
