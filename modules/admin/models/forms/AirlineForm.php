<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Airline;

/**
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class AirlineForm extends Airline
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