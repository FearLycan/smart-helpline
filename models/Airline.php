<?php

namespace app\models;

use app\modules\admin\components\AuthorBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%airline}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $additional_fields
 * @property int $author_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $author
 * @property UserAirline[] $userAirlines
 * @property User[] $users
 */
class Airline extends ActiveRecord
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
    public static function tableName()
    {
        return '{{%airline}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'additional_fields'], 'string'],
            [['author_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'additional_fields' => 'Additional Fields',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAirlines()
    {
        return $this->hasMany(UserAirline::className(), ['airline_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_airline}}', ['airline_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public function getAdditionalFields()
    {
        return json_decode($this->additional_fields, true);
    }

    /**
     * @param $value
     */
    public function setAdditionalFields($value)
    {
        $this->additional_fields = json_encode($value);
    }
}
