<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Użytkownicy', 'url' => ['index']];
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
            //'password',
            'role',
            'status',
            'registered_at',
            'last_login_at',
            //'auth_key',
            //'verification_code',
        ],
    ]) ?>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h3>Kategorie do któych należy użytkownik</h3>

            <?php if ($model->categories): ?>
                <table class="table table-striped table-hover">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kategoria</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($model->categories as $key => $category): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td> <?= Html::a($category->category->name, ['category/view', 'id' => $category->category_id]) ?> </td>
                            <td>
                                <?= Html::a('Usuń użytkownika z tej kategorii', ['user/delete-link-category',
                                    'user_id' => $category->user_id,
                                    'category_id' => $category->category_id
                                ],
                                    [
                                        'class' => 'btn btn-danger btn-xs',
                                        'data-confirm' => 'Czy na pewno usunąć ten element?',
                                        'data-method' => 'post'
                                    ]
                                ) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Brak przypisanych kategorii</p>
            <?php endif; ?>
        </div>
    </div>

</div>
