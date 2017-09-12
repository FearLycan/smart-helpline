<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\RoutingCategory */

$this->title = 'Add routing category';
$this->params['breadcrumbs'][] = ['label' => 'Routing categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routing-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
