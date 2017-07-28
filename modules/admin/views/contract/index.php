<?php

use app\modules\admin\models\Contract;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kontrakty';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj kontrakt', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'airline_name',
            [
                'attribute' => 'airline_name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data Contract */
                    return Html::a($data->airline_name, ['view', 'id' => $data->id]);
                },

            ],
            [
                'attribute' => 'contract_validity_from',
                'label' => 'Contract From',
                'contentOptions' => ['style' => 'width: 80px;'],
                'filter' => '<div class="drp-container input-group">' .
                    DatePicker::widget([
                        'name' => 'ContractSearch[contract_validity]',
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]) . '</div>',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'contract_validity_to',
                'label' => 'Contract To',
                'contentOptions' => ['style' => 'width: 80px;'],
                'filter' => '<div class="drp-container input-group">' .
                    DatePicker::widget([
                        'name' => 'ContractSearch[contract_validity]',
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]) . '</div>',
                'format' => ['date', 'php:Y-m-d']
            ],
            //'routing',
            'infant_fares',
            // 'ticket_designator',
            //'tour_code',
            // 'endorsment',
            // 'mixed_classes',
            // 'interline',
            // 'codeshares',
            [
                'attribute' => 'author',
                'label' => 'Autor',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data Contract */
                    return Html::a($data->author->lastname . ' ' . $data->author->name, ['user/view', 'id' => $data->author->id]);
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

            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
