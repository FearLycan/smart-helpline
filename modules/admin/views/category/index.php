<?php

use app\modules\admin\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategorie';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj kategorię', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data Category */
                    return Html::a($data->name, ['view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'Autor',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data Category */
                    return Html::a($data->author->lastname . ' ' . $data->author->name, ['user/view', 'id' => $data->author->id]);
                },
            ],
            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
