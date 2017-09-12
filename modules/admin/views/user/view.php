<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'name',
            'lastname',
            'email:email',
            [
                'label' => 'Role',
                'value' => function ($data) {
                    /* @var $data User */
                    return $data->getRoleName();
                },
            ],
            [
                'label' => 'Status',
                'value' => function ($data) {
                    /* @var $data User */
                    return $data->getStatusName();
                },
            ],
            'registered_at',
            'last_login_at',
            'last_seen',
        ],
    ]) ?>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h3>Categories assigned</h3>

            <?php if ($model->categories): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="400">Category</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($model->categories as $key => $category): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td> <?= Html::a($category->category->name, ['category/view', 'id' => $category->category_id]) ?> </td>
                                <td>
                                    <?= Html::a('Remove user form this category', ['user/delete-link-category',
                                        'user_id' => $category->user_id,
                                        'category_id' => $category->category_id
                                    ],
                                        [
                                            'class' => 'btn btn-danger btn-xs',
                                            'data-confirm' => 'Are you sure want to delete this element?',
                                            'data-method' => 'post'
                                        ]
                                    ) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No categories assigned</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Contracts assigned</h3>

            <?php if ($model->contracts): ?>
               <div class="table-responsive">
                   <table class="table table-striped table-hover">

                       <thead>
                       <tr>
                           <th>#</th>
                           <th width="400">Contracts</th>
                           <th></th>
                       </tr>
                       </thead>

                       <tbody>
                       <?php foreach ($model->contracts as $key => $contract): ?>
                           <?php /* @var $contract \app\modules\admin\models\Contract */ ?>
                           <tr>
                               <td><?= $key + 1 ?></td>
                               <td> <?= Html::a($contract->contract->airline_name, ['contract/view', 'id' => $contract->contract_id]) ?> </td>
                               <td>
                                   <?= Html::a('Remove user form this contract', ['user/delete-link-contract',
                                       'user_id' => $contract->user_id,
                                       'contract_id' => $contract->contract_id
                                   ],
                                       [
                                           'class' => 'btn btn-danger btn-xs',
                                           'data-confirm' => 'Are you sure want to delete this element?',
                                           'data-method' => 'post'
                                       ]
                                   ) ?>
                               </td>
                           </tr>
                       <?php endforeach; ?>
                       </tbody>
                   </table>
               </div>
            <?php else: ?>
                <p>No contracts assigned</p>
            <?php endif; ?>
        </div>
    </div>

</div>
