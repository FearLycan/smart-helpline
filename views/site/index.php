<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\Category;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Smart Helpline';
?>
<div class="site-index">

    <h1>Kategorie, do których należysz:</h1>

    <?php Pjax::begin(); ?>

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
                    return Html::a($data->name, ['site/view', 'id' => $data->id]);
                },
                'contentOptions' => ['style' => 'width: 200px;'],
            ],
            [
                'attribute' => 'description',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data Category */
                    return Html::a($data->shortDescription, ['site/view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'Autor',
                'value' => function ($data) {
                    /* @var $data Category */
                    return $data->author->lastname . ' ' . $data->author->name;
                },
                'contentOptions' => ['style' => 'width: 150px; text-align: center;'],
            ],
            [
                'attribute' => 'updated_at',
                'contentOptions' => ['style' => 'width: 150px; text-align: center;'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
