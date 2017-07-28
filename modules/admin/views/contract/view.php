<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contract */

$this->title = $model->airline_name;
$this->params['breadcrumbs'][] = ['label' => 'Kontrakty', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edytuj', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Usuń', ['delete', 'id' => $model->id], [
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
            'airline_name',
            'contract_validity_from',
            'contract_validity_to',
            'routing',
            'infant_fares',
            'ticket_designator',
            'tour_code',
            'endorsment',
            'mixed_classes',
            'interline',
            'codeshares',
            [
                'label' => 'Autor',
                'format' => 'raw',
                'value' => Html::a($model->author->lastname . ' ' . $model->author->name, ['user/view', 'id' => $model->author->id]),
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
