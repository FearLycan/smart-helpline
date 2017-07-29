<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\Contract;

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
            [['contract_validity_from','contract_validity_to'], 'safe'],
            [[
                'mixed_classes','airline_name', 'routing', 'infant_fares', 'ticket_designator', 'tour_code',
                'endorsment', 'interline', 'codeshares', 'routing_subcat_1_description', 'routing_subcat_2_description',
                'routing_subcat_1', 'routing_subcat_2'
            ], 'string', 'max' => 255],
        ];
    }
}
