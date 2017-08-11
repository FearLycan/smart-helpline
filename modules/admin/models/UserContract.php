<?php

namespace app\modules\admin\models;

/**
 * This is the model class for table "{{%user_contract}}"
 */
class UserContract extends \app\models\UserContract
{
    /**
     * @param $user_id
     */
    public static function deleteAllContracts($user_id)
    {
        $contracts = UserContract::find()->where(['user_id' => $user_id])->all();

        foreach ($contracts as $contract) {
            $contract->delete();
        }
    }
}
