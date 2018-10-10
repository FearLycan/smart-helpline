<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AfterHoursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'After Hours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="after-hours-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                    /* @var $data Contract */
                    return Html::a($data->name, ['after-hours/view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'created_at',
                'contentOptions' => ['style' => 'width: 160px;'],
                'filter' => '<div class="drp-container input-group">' .
                    DatePicker::widget([
                        'name' => 'ContractSearch[created_at]',
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]) . '</div>',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
