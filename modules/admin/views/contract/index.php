<?php

use app\modules\admin\models\Contract;
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

            'airline_name',
            'contract_validity',
            'routing',
            'infant_fares',
            // 'ticket_designator',
            'tour_code',
            // 'endorsment',
            // 'mixed_classes',
            // 'interline',
            // 'codeshares',
            [
                'attribute' => 'author',
                'label' => 'Autor',
                'value' => function ($data) {
                    /* @var $data Contract */
                    return $data->author->lastname . ' ' . $data->author->name;
                },

            ],
            'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
