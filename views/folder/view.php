<?php

use app\modules\admin\components\Helpers;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Folder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['site/view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = ['label' => 'Folder'];

foreach ($model->getParentsShort($fid) as $parent) {
    $this->params['breadcrumbs'][] = ['label' => Helpers::cutThis($parent['name'], 25), 'url' => ['view', 'id' => $parent['id'], 'cid' => $category->id]];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-view">

    <h1>Folder: <?= Html::encode($model->name) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description'
        ],
    ]) ?>

    <?php if($dataProvider->getTotalCount()): ?>

    <h2>Folders in folder <strong><?= $model->name ?></strong></h2>

    <hr>

    <?= $this->render('_search', ['model' => $searchModel, 'action' => ['view', 'id' => $model->id, 'cid' => $category->id, 'fid' => $fid]]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '_folder',
        'viewParams' => ['cid' => $category->id, 'fid' => $fid],
        'options' => [
            'tag' => 'div',
            'class' => 'row',
        ],
    ]); ?>

    <hr>

    <?php endif; ?>

    <h2>Files in folder <strong><?= $model->name ?></strong></h2>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataFileProvider,
        'filterModel' => $searchFileModel,
        'options' => ['class' => 'grid-view table-responsive'],
        'columns' => Helpers::getColumnsFileUsersGride(),
    ]); ?>

</div>