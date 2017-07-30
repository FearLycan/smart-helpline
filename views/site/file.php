<?php

use app\modules\admin\components\Helpers;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $searchModel app\modules\admin\models\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kategoria', 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = ['label' => 'Pliki', 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1>Nazwa pliku: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Pobierz', ['download', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description',
            [
                'label' => 'Autor',
                'format' => 'raw',
                'value' => $model->author->lastname . ' ' . $model->author->name,
            ],
            [
                'label' => 'Kategoria',
                'format' => 'raw',
                'value' => $model->category->name,
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
