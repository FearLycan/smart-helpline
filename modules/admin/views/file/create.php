<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\File */
/* @var $category app\modules\admin\models\Category */
/* @var $contract app\modules\admin\models\Contract */

$this->title = 'Prześlij pliki';
$this->params['breadcrumbs'][] = ['label' => 'Pliki', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">


    <?php if (!empty($contract)): ?>
        <h1><?= Html::encode($this->title) ?> do kontraktu: <?= $contract->airline_name ?></h1>
    <?php else: ?>
        <h1><?= Html::encode($this->title) ?> do kategorii: <?= $category->name ?></h1>
    <?php endif; ?>



    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
