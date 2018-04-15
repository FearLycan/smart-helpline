<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = $model->airline_name;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'airline_name',
            [
                'label' => 'Contract Validity',
                'value' => date("Y-m-d", strtotime($model->contract_validity_from)) . ' to ' . date("Y-m-d", strtotime($model->contract_validity_to)),
            ],
            [
                'label' => 'Description',
                'value' => $model->contract_description,
            ],
            /* [
                 'label' => 'Routing No. 1',
                 'value' => $model->routing_subcat_1 . ' ' . $model->routing_subcat_1_description
             ],
             [
                 'label' => 'Routing No. 2',
                 'value' => $model->routing_subcat_2 . ' ' . $model->routing_subcat_2_description
             ],*/
            [
                'label' => 'Autor',
                'format' => 'raw',
                'value' => Html::a($model->author->name . ' ' . $model->author->lastname, ['user/view', 'id' => $model->author->id]),
            ],
            //'note:raw',
            'created_at',
            'updated_at',
        ],
    ]) ?>


    <div class="row">
        <?php if (!empty($model->infant_fares)): ?>
            <div class="col-md-12">
                <h3>Infant fares</h3>
                <?= $model->infant_fares ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->ticket_designator)): ?>
            <div class="col-md-12">
                <h3>Ticket designator</h3>
                <?= $model->ticket_designator ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->tour_code)): ?>
            <div class="col-md-12">
                <h3>Tour code</h3>
                <?= $model->tour_code ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->endorsment)): ?>
            <div class="col-md-12">
                <h3>Endorsment</h3>
                <?= $model->endorsment ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->mixed_classes)): ?>
            <div class="col-md-12">
                <h3>Mixed classes</h3>
                <?= $model->mixed_classes ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->interline)): ?>
            <div class="col-md-12">
                <h3>Interline</h3>
                <?= $model->interline ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->codeshares)): ?>
            <div class="col-md-12">
                <h3>Codeshares</h3>
                <?= $model->codeshares ?>
                <hr>
            </div>
        <?php endif; ?>

        <?php if (!empty($model->note)): ?>
            <div class="col-md-12">
                <h3>Additional Notes</h3>
                <?= $model->note ?>
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

    <div class="row">
        <div class="col-md-12">
            <h3>Files</h3>

            <?php if (empty($files)): ?>
                <p>No files.</p>
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
                                <td><?= Html::a($file->name, ['site/download', 'id' => $file->id], ['data-pjax' => '0']); ?></td>
                                <td width="250"><?= $file->author->name . ' ' . $file->author->lastname ?></td>
                                <td width="70" class="text-center">
                                    <?= Html::a('Download', ['site/download', 'id' => $file->id], [
                                        'class' => 'btn btn-success btn-xs',
                                        'data-pjax' => '0',
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
