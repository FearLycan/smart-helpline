<?php

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

    <p>
        <?= Html::a('Create Contract', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'airline_name',
            'contract_validity_from',
            'routing',
            'infant_fares',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
