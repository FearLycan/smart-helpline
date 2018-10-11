<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_airline}}".
 *
 * @property int $user_id
 * @property int $airline_id
 *
 * @property Airline $airline
 * @property User $user
 */
class UserAirline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_airline}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'airline_id'], 'required'],
            [['user_id', 'airline_id'], 'integer'],
            [['user_id', 'airline_id'], 'unique', 'targetAttribute' => ['user_id', 'airline_id']],
            [['airline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Airline::className(), 'targetAttribute' => ['airline_id' => 'id']],
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
            'airline_id' => 'Airline ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAirline()
    {
        return $this->hasOne(Airline::className(), ['id' => 'airline_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
