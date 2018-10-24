<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\searches\FolderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Folders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'p0']); ?>

    <p>
        <button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="modal"
                data-target="#myModal">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new
        </button>
    </p>

    <hr>

    <?= $this->render('_search', ['model' => $searchModel, 'action' => ['index']]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '_folder',
        'options' => [
            'tag' => 'div',
            'class' => 'row',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<!-- Modal -->
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
                    'model' => $form,
                ]) ?>
            </div>
        </div>
    </div>
</div>
