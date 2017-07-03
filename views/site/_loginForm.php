<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-form">
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validateOnType' => true,
        'validateOnSubmit' => true,
        'validateOnChange' => true,
    ]); ?>

    <div class="form-group">
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
