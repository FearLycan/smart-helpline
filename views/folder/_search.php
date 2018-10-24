<?php

use app\modules\admin\models\User;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\searches\FolderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="folder-search">

        <?php $form = ActiveForm::begin([
            'action' => $action,
            'id' => 'folder-search',
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <div class="col-md-12">
            <?= $form->field($model, 'name')->label('Search by name'); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>