<?php

namespace app\modules\admin\models;

use app\modules\admin\components\AuthorBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contract}}".
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class Contract extends \app\models\Contract
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
}
