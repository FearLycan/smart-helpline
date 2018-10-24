<?php

use app\components\Helpers;
use yii\helpers\Url;

/* @var $model \app\models\Folder */

?>


<div class="col-sm-3 col-md-2">
    <a href="<?= Url::to(['folder/view', 'id' => $model->id, 'cid' => $cid, 'fid' => $fid]) ?>" style="text-decoration: none;">
        <div class="thumbnail abc" title="<?= $model->name ?>">
            <img src="<?= Url::to(['/images/folder.png']) ?>" alt="<?= $model->name ?>" class="img-responsive">
            <div class="caption">
                <h4><?= Helpers::cutThis($model->name, 20) ?></h4>
            </div>
        </div>
    </a>
</div>
