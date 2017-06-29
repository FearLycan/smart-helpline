<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\File */
/* @var $category app\modules\admin\models\Category */

$this->title = 'Prześlij pliki';
$this->params['breadcrumbs'][] = ['label' => 'Pliki', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <h1><?= Html::encode($this->title) ?> do kategorii: <?= $category->name ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
