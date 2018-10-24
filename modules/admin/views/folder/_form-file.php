<?php

use app\modules\admin\components\Helpers;
use app\modules\admin\models\forms\FileForm;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if ($model->scenario == FileForm::SCENARIO_CREATE): ?>

        <?= $form->field($model, 'files[]')->fileInput(['multiple' => true]) ?>

    <?php elseif ($model->scenario == FileForm::SCENARIO_UPDATE): ?>

        <?= $form->field($model, 'name')->textInput() ?>

        <?= $form->field($model, 'description')->widget(TinyMce::className(), [
            'options' => ['rows' => 6],
            'language' => 'pl',
            'clientOptions' => Helpers::getTinyMceOptions()
        ]); ?>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
