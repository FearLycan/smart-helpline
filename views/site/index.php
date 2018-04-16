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

    <h1>Categories you are added to:</h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view table-responsive'],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 45px;'],
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data Category */
                    return Html::a($data->name, ['site/view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'Author',
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
