<?php

use app\modules\admin\models\File;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $searchModel app\modules\admin\models\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pliki', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
        <?= Html::a('Pobierz', ['download', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'label' => 'Opis',
                'format' => 'raw',
                'value' => $model->description,
            ],
            [
                'label' => 'Autor',
                'format' => 'raw',
                'value' => Html::a($model->author->lastname . ' ' . $model->author->name, ['user/view', 'id' => $model->author->id]),
            ],
            [
                'label' => 'Kategoria',
                'format' => 'raw',
                'value' => function ($model) {
                    /* @var $data File */
                    if ($model->category_id != 0) {
                        return Html::a($model->category->name, ['category/view', 'id' => $model->category_id]);
                    } else {
                        return Html::a('Kontrakt', ['contract/view', 'id' => $model->contract_id]);
                    }
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
