<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\AfterHours;

/**
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class HoursForm extends AfterHours
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['additional_fields', 'description'], 'string'],
        ];
    }
}