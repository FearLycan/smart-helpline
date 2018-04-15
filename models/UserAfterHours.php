<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_after_hours}}".
 *
 * @property int $user_id
 * @property int $hour_id
 *
 * @property AfterHours $hour
 * @property User $user
 */
class UserAfterHours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_after_hours}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'hour_id'], 'required'],
            [['user_id', 'hour_id'], 'integer'],
            [['user_id', 'hour_id'], 'unique', 'targetAttribute' => ['user_id', 'hour_id']],
            [['hour_id'], 'exist', 'skipOnError' => true, 'targetClass' => AfterHours::className(), 'targetAttribute' => ['hour_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'hour_id' => 'Hour ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHour()
    {
        return $this->hasOne(AfterHours::className(), ['id' => 'hour_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
