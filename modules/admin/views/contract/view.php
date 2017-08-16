<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contract */
/* @var $file app\modules\admin\models\File */

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
        <?= Html::a('Prześlij pliki', ['file/create', 'id' => 0, 'contractId' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>


    <div class="row">

    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'airline_name',
            [
                'label' => 'Contract Validity',
                'value' => date("Y-m-d", strtotime($model->contract_validity_from)) . ' to ' . date("Y-m-d", strtotime($model->contract_validity_to)) . ', ' . $model->contract_description,
            ],
            // 'contract_validity_from',
            // 'contract_validity_to',
            //'routing',
            [
                'label' => 'Routing No. 1',
                'value' => $model->routing_subcat_1 . ' ' . $model->routing_subcat_1_description
            ],
            [
                'label' => 'Routing No. 2',
                'value' => $model->routing_subcat_2 . ' ' . $model->routing_subcat_2_description
            ],
            //'routing_subcat_1',
            //'routing_subcat_2',
            //'infant_fares',
            [
                'attribute' => 'infant_fares',
                'format' => 'raw',
            ],
            'ticket_designator:raw',
            'tour_code:raw',
            'endorsment:raw',
            'mixed_classes:raw',
            'interline:raw',
            'codeshares:raw',
            [
                'label' => 'Autor',
                'format' => 'raw',
                'value' => Html::a($model->author->lastname . ' ' . $model->author->name, ['user/view', 'id' => $model->author->id]),
            ],
            'note:raw',
            'created_at:raw',
            'updated_at:raw',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <h3>Pliki</h3>

            <?php if (empty($files)): ?>
                <p>Brak plików.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nazwa</th>
                            <th>Autor</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($files as $key => $file): ?>
                            <tr>
                                <td width="30"><?= $key + 1 ?></td>
                                <td><?= Html::a($file->name, ['file/download', 'id' => $file->id], ['data-pjax' => '0']); ?></td>
                                <td width="250"><?= $file->author->name . ' ' . $file->author->lastname ?></td>
                                <td width="170" class="text-center">
                                    <?= Html::a('Pobierz', ['file/download', 'id' => $file->id], [
                                        'class' => 'btn btn-success btn-xs',
                                        'data-pjax' => '0',
                                    ]); ?>

                                    <?= Html::a('Edytuj', ['file/update', 'id' => $file->id], [
                                        'class' => 'btn btn-primary btn-xs',
                                        'data-pjax' => '0',
                                    ]); ?>

                                    <?= Html::a('Usuń', ['file/delete', 'id' => $file->id], [
                                        'class' => 'btn btn-danger btn-xs',
                                        'data-pjax' => '0',
                                        'data-confirm' => 'Czy na pewno usunąć ten element?',
                                        'data-method' => 'post',
                                    ]); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
