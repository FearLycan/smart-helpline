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
            'name',
            //'description:ntext',
            [
                'attribute' => 'author',
                'label' => 'Autor',
                'value' => function ($data) {
                    /* @var $data Category */
                    return $data->author->lastname . ' ' . $data->author->name;
                },
            ],
//            [
//                'label' => 'Status',
//                'attribute' => 'status',
//                'filter' => User::getStatusNames(),
//                'value' => function ($data) {
//                    /* @var $data User */
//                    return $data->getStatusName();
//                },
//                'contentOptions' => ['style' => 'width: 100px;'],
//            ],
            //'author_id',
            'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
