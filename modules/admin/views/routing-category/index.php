<?php

use app\modules\admin\models\RoutingCategory;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RoutingCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategorie Routingu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routing-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj kategorię routingu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view table-responsive'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data RoutingCategory */
                    return Html::a($data->name, ['view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'Autor',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data RoutingCategory */
                    return Html::a($data->author->lastname . ' ' . $data->author->name, ['user/view', 'id' => $data->author->id]);
                },
            ],
            [
                'attribute' => 'created_at',
                'contentOptions' => ['style' => 'width: 160px;'],
            ],
            ['class' => 'yii\grid\ActionColumn', 'contentOptions' => ['style' => 'width: 80px;'],],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
