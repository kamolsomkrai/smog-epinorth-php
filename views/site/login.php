<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login-wrapper">
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "<div class='col-lg-12'>{input}</div>\n{error}",
                'inputOptions' => ['class' => 'form-control input-animated'],
                'errorOptions' => ['class' => 'invalid-feedback d-block text-left'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username', 'autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-animated', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<style>
    body {
        background-color: #f7f9fc;
        font-family: 'Arial', sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .site-login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: #f7f9fc;
    }

    .site-login {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .site-login h1 {
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: bold;
        color: #007bff;
    }

    .site-login p {
        margin-bottom: 20px;
        color: #666;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        transition: all 0.3s ease;
        width: 100%;
        margin-bottom: 15px;
    }

    .form-control.input-animated:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-primary.btn-animated:hover {
        background-color: #0056b3;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        transform: translateY(-2px);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group.text-center {
        text-align: center;
    }

    @media (max-width: 768px) {
        .site-login {
            padding: 20px 30px;
            width: 90%;
        }

        .site-login h1 {
            font-size: 20px;
        }

        .form-control {
            padding: 8px;
        }

        .btn-primary {
            padding: 8px 16px;
            font-size: 14px;
        }
    }
</style>
