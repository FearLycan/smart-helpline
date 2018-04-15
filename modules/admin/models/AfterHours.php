<?php

namespace app\modules\admin\models;

use app\models\UserAfterHours;
use app\modules\admin\components\AuthorBehavior;
use app\modules\admin\components\Helpers;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class AfterHours extends \app\models\AfterHours
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date("Y-m-d H:i:s"),
            ],
            'author' => [
                'class' => AuthorBehavior::className(),
                'field' => 'author_id',
                'value' => Yii::$app->user->id,
            ]
        ];
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

    public static function makeConnection($users, $hour_id)
    {
        $hours = UserAfterHours::find()->where(['hour_id' => $hour_id])->all();

        foreach ($hours as $hour) {
            $hour->delete();
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                $con = new UserAfterHours();
                $con->hour_id = $hour_id;
                $con->user_id = $user;
                $con->save();

                unset($con);
            }
        }
    }
}
