<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'airline_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract_validity_from')->textInput() ?>

    <?= $form->field($model, 'routing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'infant_fares')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket_designator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endorsment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codeshares')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'contract_validity_to')->textInput() ?>

    <?= $form->field($model, 'mixed_classes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'routing_subcat_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'routing_subcat_1_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'routing_subcat_2_description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
