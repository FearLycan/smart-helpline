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

        <div class="col-md-8">
            <?= $form->field($model, 'name')->label('Search by name'); ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'author_id')
                ->dropDownList(
                    ArrayHelper::map(User::find()->where(['role' => User::ROLE_ADMIN])->orderBy(['name' => SORT_ASC])->all(), 'id', 'fullName'),
                    ['prompt' => '']
                )->label('Search by author'); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<?php $this->beginBlock('script') ?>
    <script>
        $(document).on('change', '#foldersearch-author_id', function(){
            $(this).closest('form').submit();
        })
    </script>
<?php $this->endBlock() ?>