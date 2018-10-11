<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Airline */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Airlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="after-hours-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name:ntext',
            [
                'label' => 'Autor',
                'format' => 'raw',
                'value' => $model->author->name . ' ' . $model->author->lastname,
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <div class="row">

        <?php if (!empty($model->description)): ?>
            <div class="col-md-12">
                <h3>Description</h3>
                <?= $model->description ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->additional_fields)): ?>

            <?php for ($i = 1; $i < count($model->getAdditionalFields()); $i += 2): ?>
                <div class="col-md-12">
                    <h3><?= $model->getAdditionalFields()[$i - 1] ?></h3>
                    <?= $model->getAdditionalFields()[$i] ?>
                    <hr>
                </div>
            <?php endfor; ?>

        <?php endif; ?>
    </div>

</div>
