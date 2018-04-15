<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add user', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'grid-view table-responsive'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'contentOptions' => ['style' => 'width: 40px;']],
            [
                'label' => 'Name',
                'attribute' => 'name',
                'contentOptions' => ['style' => 'width: 150px;'],
            ],
            [
                'label' => 'Last Name',
                'attribute' => 'lastname',
                'contentOptions' => ['style' => 'width: 150px;'],
            ],
            [
                'label' => 'Email',
                'attribute' => 'email',
                'contentOptions' => ['style' => 'width: 150px;'],
            ],
            [
                'label' => 'Role',
                'attribute' => 'role',
                'filter' => User::getRolesNames(),
                'value' => function ($data) {
                    /* @var $data User */
                    return $data->getRoleName();
                },
                'contentOptions' => ['style' => 'width: 100px;'],
            ],
            [
                'label' => 'Status',
                'attribute' => 'status',
                'filter' => User::getStatusNames(),
                'value' => function ($data) {
                    /* @var $data User */
                    return $data->getStatusName();
                },
                'contentOptions' => ['style' => 'width: 100px;'],
            ],
            [
                'label' => 'Registered at',
                'attribute' => 'registered_at',
                'contentOptions' => ['style' => 'width: 160px;'],
            ],
            [
                'label' => 'Last seen',
                'attribute' => 'last_seen',
                'contentOptions' => ['style' => 'width: 160px;'],
            ],
            // 'lastname',
            //'email:email',
            // 'password',
            // 'role',
            // 'status',
            // 'registered_at',
            // 'last_login_at',
            // 'auth_key',
            // 'verification_code',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 70px;']
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
