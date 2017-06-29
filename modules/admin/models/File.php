<?php


namespace app\modules\admin\models;

use app\modules\admin\components\AuthorBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * File model for admin panel.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class File extends \app\models\File
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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