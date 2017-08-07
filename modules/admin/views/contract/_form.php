<?php

use app\modules\admin\components\Helpers;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'airline_name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'contract_validity_from')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Wybierz date'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'contract_validity_to')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Wybierz date'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'contract_description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'routing_subcat_1')->textInput(['maxlength' => true])->label('Between No. 1') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'routing_subcat_1_description')->textInput(['maxlength' => true])->label('Between No. 1 Description') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'routing_subcat_2')->textInput(['maxlength' => true])->label('Between No. 2') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'routing_subcat_2_description')->textInput(['maxlength' => true])->label('Between No. 2 Description') ?>
        </div>

    </div>

    <?= $form->field($model, 'infant_fares')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'pl',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'ticket_designator')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'pl',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'tour_code')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'pl',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'endorsment')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'pl',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'mixed_classes')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'pl',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'interline')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'pl',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <?= $form->field($model, 'codeshares')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'pl',
        'clientOptions' => Helpers::getTinyMceOptions()
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
