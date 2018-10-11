<?php

use app\models\File;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $searchModel app\modules\admin\models\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contract', 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['/files/' . $model->real_name], true);
$scr = "https://docs.google.com/gview?url=" . $url . "&embedded=true";
?>
<div class="category-view">

    <h1>File name: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Download', ['site/download', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description',
            [
                'label' => 'Author',
                'format' => 'raw',
                'value' => $model->author->lastname . ' ' . $model->author->name,
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <?php if (in_array($model->format, File::formats())): ?>
        <div class="row">
            <div class="col-md-12">
                <h3>Podgląd pliku <?= Html::encode($model->name) ?></h3>
                <hr>

                <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?= $url ?>"
                        width='100%' height='600px' frameborder='0'>This is an embedded
                    <a target='_blank' href='http://office.com'>
                        Microsoft
                        Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office
                        Online</a>.
                </iframe>

            </div>
        </div>
    <?php endif; ?>

</div>
