<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\FolderCategory;

class QuickCategoryFolderForm extends FolderCategory
{
    public $categories;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categories'], 'safe'],
        ];
    }
}