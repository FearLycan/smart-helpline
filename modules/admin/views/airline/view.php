<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AfterHours */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Airline', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="after-hours-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name:ntext',
            [
                'label' => 'Autor',
                'format' => 'raw',
                'value' => Html::a($model->author->name . ' ' . $model->author->lastname, ['user/view', 'id' => $model->author->id]),
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'contract-form']); ?>

        <div class="col-md-12">
            <?= $form->field($quickUserForm, 'users')->widget(Select2::classname(), [
                'data' => $users,
                'size' => Select2::LARGE,
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Select users ...', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true
                ],
            ]); ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($model->description)): ?>
            <div class="col-md-12">
                <h3>Description</h3>
                <?= $model->description ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->additional_fields)): ?>

            <?php for ($i = 1; $i < count($model->getAdditionalFields()); $i += 2): ?>
                <div class="col-md-12">
                    <h3><?= $model->getAdditionalFields()[$i - 1] ?></h3>
                    <?= $model->getAdditionalFields()[$i] ?>
                    <hr>
                </div>
            <?php endfor; ?>

        <?php endif; ?>
    </div>

</div>
