<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AfterHours */

$this->title = 'Add After Hours';
$this->params['breadcrumbs'][] = ['label' => 'After Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="after-hours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
