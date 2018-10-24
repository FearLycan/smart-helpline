<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Folder;

class FolderForm extends Folder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['name'], 'required'],
        ];
    }
}