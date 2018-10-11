<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $category \app\models\Category */

use app\models\File;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Kategoria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>

<p><strong>Author: </strong><?= Html::encode($category->author->name . ' ' . $category->author->lastname) ?></p>
<p><strong>Created at: </strong><?= Html::encode($category->created_at) ?></p>
<p><strong>Updated at: </strong><?= Html::encode($category->updated_at) ?></p>

<div class="row">
    <div class="col-md-12">
        <h3>Description</h3>
        <?= $category->description ?>
    </div>
</div>

<hr>

<h3>Files list</h3>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => ['class' => 'grid-view table-responsive'],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style' => 'width: 40px; text-align: center']
        ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                /* @var $data File */
                return Html::a($data->name, ['site/download', 'id' => $data->id], [
                    'data-pjax' => '0'
                ]);
            },
        ],
        [
            'attribute' => 'description',
            'format' => 'raw',
            'value' => function ($data) {
                /* @var $data File */
                return Html::a($data->getShortDescription(), ['site/file', 'id' => $data->id], [
                    'data-pjax' => '0'
                ]);
            },
        ],
        [
            'attribute' => 'author',
            'label' => 'Author',
            'value' => function ($data) {
                /* @var $data File */
                return $data->author->lastname . ' ' . $data->author->name;
            },
            'contentOptions' => ['style' => 'width: 150px; text-align: center;'],
        ],
        [
            'attribute' => 'format',
            'contentOptions' => ['style' => 'width: 50px; text-align: center'],
        ],
        [
            'attribute' => 'created_at',
            'contentOptions' => ['style' => 'width: 150px;'],
        ],
        [
            'label' => '',
            'format' => 'raw',
            'contentOptions' => ['style' => 'width: 50px; text-align:center;'],
            'value' => function ($data) {
                /* @var $data File */

                if (in_array($data->format, File::formats())) {
                    $url = Url::to(['site/file', 'id' => $data->id]);
                } else {
                    $url = Url::to(['/files/' . $data->real_name]);
                }

                return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>', $url, [
                    'class' => 'btn btn-info btn-xs',
                    'data-pjax' => '0',
                    'target' => '_blank',
                ]);
            },
        ],
    ],
]); ?>
