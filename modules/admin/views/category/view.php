<?php

use app\modules\admin\components\Helpers;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $searchModel app\modules\admin\models\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Upload files', ['file/create', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name:raw',
            [
                'label' => 'Author',
                'format' => 'raw',
                'value' => Html::a($model->author->lastname . ' ' . $model->author->name, ['user/view', 'id' => $model->author->id]),
            ],
            'created_at:raw',
            'updated_at:raw',
        ],
    ]) ?>

    <div class="row">
        <?php if (!empty($model->description)): ?>
            <div class="col-md-12">
                <h3>Description</h3>
                <?= $model->description ?>
            </div>
        <?php endif; ?>
    </div>

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

    <h2>Files in this Category</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view table-responsive'],
        'columns' => Helpers::getColumnsFileGride(),
    ]); ?>


</div>
