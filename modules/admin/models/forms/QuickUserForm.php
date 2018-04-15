<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\User;

class QuickUserForm extends User
{
    public $users;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users'], 'safe'],
        ];
    }
}