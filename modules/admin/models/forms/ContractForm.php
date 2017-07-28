<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Contract;
use Yii;

/**
 * This is the model class for table "{{%contract}}".
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class ContractForm extends Contract
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['airline_name', 'routing', 'infant_fares', 'ticket_designator', 'tour_code', 'endorsment', 'interline', 'codeshares'], 'required'],
            [['contract_validity'], 'safe'],
            [['mixed_classes','airline_name', 'routing', 'infant_fares', 'ticket_designator', 'tour_code', 'endorsment', 'interline', 'codeshares'], 'string', 'max' => 255],
        ];
    }
}
