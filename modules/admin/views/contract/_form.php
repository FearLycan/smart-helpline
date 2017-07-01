<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'airline_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract_validity')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Wybierz date'],
        'type' => DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy'
        ]
    ]) ?>

    <?= $form->field($model, 'routing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'infant_fares')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket_designator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tour_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endorsment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mixed_classes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codeshares')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
