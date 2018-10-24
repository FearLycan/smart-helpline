<?php

use app\components\Helpers;
use yii\helpers\Url;

/* @var $model \app\modules\admin\models\Folder */

?>


<div class="col-sm-3 col-md-2">
    <a href="<?= Url::to(['view', 'id' => $model->id]) ?>" style="text-decoration: none;">
        <div class="thumbnail abc" title="<?= $model->name ?>">
            <img src="<?= Url::to(['/images/folder.png']) ?>" alt="<?= $model->name ?>" class="img-responsive">

            <a href="<?= Url::to(['folder/delete', 'id' => $model->id]) ?>" data-method="post"
               data-confirm="Are you sure you want to delete this folder?">
                <img src="<?= Url::to(['/images/x.png']) ?>" alt="Delete" title="Delete <?= $model->name ?>"
                     class="img-responsive remove-icon">
            </a>


            <div class="caption">
                <h4><?= Helpers::cutThis($model->name, 20) ?></h4>
            </div>
        </div>
    </a>
</div>
