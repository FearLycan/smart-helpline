<?php

namespace app\modules\admin\models\forms;


use app\modules\admin\models\FolderCategory;

class QuickFolderCategoryForm extends FolderCategory
{
    public $folders;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['folders'], 'safe'],
        ];
    }
}