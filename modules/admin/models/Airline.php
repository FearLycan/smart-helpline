<?php

namespace app\modules\admin\models;

use app\modules\admin\components\Helpers;

class Airline extends \app\models\Airline
{
    public static function makeConnection($users, $airline_id)
    {
        $airlines = UserAirline::find()->where(['airline_id' => $airline_id])->all();

        foreach ($airlines as $airline) {
            $airline->delete();
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                $con = new UserAirline();
                $con->airline_id = $airline_id;
                $con->user_id = $user;
                $con->save();

                unset($con);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            foreach ($this->getAttributes() as $key => $item){
                $this->{$key} = Helpers::checkString($item);
            }

            return true;
        } else {
            return false;
        }
    }
}
