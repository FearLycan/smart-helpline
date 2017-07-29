<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RoutingCategory */

$this->title = 'Dodaj kategorię routingu';
$this->params['breadcrumbs'][] = ['label' => 'Kategorie Routingu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routing-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
