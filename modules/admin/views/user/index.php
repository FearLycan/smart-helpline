<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Użytkownicy';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dodaj użytkownika', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','contentOptions' => ['style' => 'width: 40px;']],
            [
                'label' => 'Nazwisko',
                'attribute' => 'lastname',
                'contentOptions' => ['style' => 'width: 150px;'],
            ],
            [
                'label' => 'Imię',
                'attribute' => 'name',
                'contentOptions' => ['style' => 'width: 150px;'],
            ],
            [
                'label' => 'Email',
                'attribute' => 'email',
                'contentOptions' => ['style' => 'width: 150px;'],
            ],
            [
                'label' => 'Rola',
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
                'label' => 'Data rejestracji',
                'attribute' => 'registered_at',
                'contentOptions' => ['style' => 'width: 160px;'],
            ],
            [
                'label' => 'Ostatnia aktywność',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
