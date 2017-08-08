<?php

use app\models\Contract;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contracts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'airline_name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data Contract */
                    return Html::a($data->airline_name, ['contract/view', 'id' => $data->id]);
                },
                'contentOptions' => ['style' => 'width: 200px;'],
            ],
            [
                'attribute' => 'contract_validity_from',
                'label' => 'Contract From',
                'contentOptions' => ['style' => 'width: 80px;'],
                'filter' => '<div class="drp-container input-group">' .
                    DatePicker::widget([
                        'name' => 'ContractSearch[contract_validity_from]',
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
                        'name' => 'ContractSearch[contract_validity_to]',
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]) . '</div>',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute' => 'routing',
                'value' => function ($data) {
                    /* @var $data Contract */
                    return strip_tags($data->routing);
                },
            ],
            [
                'attribute' => 'infant_fares',
                'value' => function ($data) {
                    /* @var $data Contract */
                    return strip_tags($data->infant_fares);
                },
            ],
            //'routing',
            //'infant_fares',
            // 'ticket_designator',
            // 'tour_code',
            // 'endorsment',
            // 'interline',
            // 'codeshares',
            // 'author_id',
            // 'created_at',
            // 'updated_at',
            // 'contract_validity_to',
            // 'mixed_classes',
            // 'contract_description',
            // 'routing_subcat_1',
            // 'routing_subcat_1_description',
            // 'routing_subcat_2',
            // 'routing_subcat_2_description',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
