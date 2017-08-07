<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'airline_name',
            'contract_validity_from',
            'routing',
            'infant_fares',
            'ticket_designator',
            'tour_code',
            'endorsment',
            'interline',
            'codeshares',
            'author_id',
            'created_at',
            'updated_at',
            'contract_validity_to',
            'mixed_classes',
            'contract_description',
            'routing_subcat_1',
            'routing_subcat_1_description',
            'routing_subcat_2',
            'routing_subcat_2_description',
        ],
    ]) ?>

</div>
