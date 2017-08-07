<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContractSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'airline_name') ?>

    <?= $form->field($model, 'contract_validity_from') ?>

    <?= $form->field($model, 'routing') ?>

    <?= $form->field($model, 'infant_fares') ?>

    <?php // echo $form->field($model, 'ticket_designator') ?>

    <?php // echo $form->field($model, 'tour_code') ?>

    <?php // echo $form->field($model, 'endorsment') ?>

    <?php // echo $form->field($model, 'interline') ?>

    <?php // echo $form->field($model, 'codeshares') ?>

    <?php // echo $form->field($model, 'author_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'contract_validity_to') ?>

    <?php // echo $form->field($model, 'mixed_classes') ?>

    <?php // echo $form->field($model, 'contract_description') ?>

    <?php // echo $form->field($model, 'routing_subcat_1') ?>

    <?php // echo $form->field($model, 'routing_subcat_1_description') ?>

    <?php // echo $form->field($model, 'routing_subcat_2') ?>

    <?php // echo $form->field($model, 'routing_subcat_2_description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
