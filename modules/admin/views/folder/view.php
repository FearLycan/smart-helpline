<?php

use app\modules\admin\components\Helpers;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Folder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Folders', 'url' => ['index']];

foreach ($model->getParents() as $parent) {
    $this->params['breadcrumbs'][] = ['label' => Helpers::cutThis($parent['name'], 25), 'url' => ['view', 'id' => $parent['id']]];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-view">

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
        <button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="modal"
                data-target="#myModal">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new
        </button>

        <button type="button" class="btn btn-warning" aria-label="Left Align" data-toggle="modal"
                data-target="#myModalFile">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Upload files
        </button>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description',
            [
                'label' => 'Author',
                'format' => 'raw',
                'value' => Html::a($model->author->name . ' ' . $model->author->lastname, ['user/view', 'id' => $model->author->id])
            ],
        ],
    ]) ?>

    <?php Pjax::begin(); ?>

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-12">
            <?= $form->field($quickCategoryFolderForm, 'categories')->widget(Select2::classname(), [
                'data' => $categories,
                'size' => Select2::LARGE,
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Select categories ...', 'multiple' => true],
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

    <h2>Folders in folder <strong><?= $model->name ?></strong></h2>

    <hr>

    <?= $this->render('_search', ['model' => $searchModel, 'action' => ['view', 'id' => $model->id]]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '_folder',
        'options' => [
            'tag' => 'div',
            'class' => 'row',
        ],
    ]); ?>

    <hr>

    <h2>Files in folder <strong><?= $model->name ?></strong></h2>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataFileProvider,
        'filterModel' => $searchFileModel,
        'options' => ['class' => 'grid-view table-responsive'],
        'columns' => Helpers::getColumnsFileGride(),
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<!-- Modal Folder -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Create new folder</h4>
            </div>
            <div class="modal-body">
                <?= $this->render('_form-folder', [
                    'model' => $form_folder,
                ]) ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal File -->
<div class="modal fade" id="myModalFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Upload new files</h4>
            </div>
            <div class="modal-body">
                <?= $this->render('_form-file', [
                    'model' => $form_file,
                ]) ?>
            </div>
        </div>
    </div>
</div>