<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AirlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Airlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Airline', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 45px;'],
            ],
            [
                'label' => 'Name',
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data \app\models\AfterHours */
                    return Html::a($data->name, ['view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'Author',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 170px;'],
                'value' => function ($data) {
                    /* @var $data \app\models\AfterHours */
                    return Html::a($data->author->name . ' ' . $data->author->lastname, ['user/view', 'id' => $data->author->id]);
                },

            ],
            [
                'attribute' => 'created_at',
                'contentOptions' => ['style' => 'width: 160px;'],
                'filter' => '<div class="drp-container input-group">' .
                    DatePicker::widget([
                        'name' => 'AirlineSearch[created_at]',
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]) . '</div>',
            ],
            [
                'contentOptions' => ['style' => 'width: 70px;'],
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
