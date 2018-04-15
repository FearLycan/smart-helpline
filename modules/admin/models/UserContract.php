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

    public static function makeConnection($users, $contract_id)
    {
        $contracts = self::find()->where(['contract_id' => $contract_id])->all();

        foreach ($contracts as $contract) {
            $contract->delete();
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                $con = new UserContract();
                $con->contract_id = $contract_id;
                $con->user_id = $user;
                $con->save();

                unset($con);
            }
        }
    }
}
