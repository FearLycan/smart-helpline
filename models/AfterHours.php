<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%after_hours}}".
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
 */
class AfterHours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%after_hours}}';
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
    public function getLinkedUsers()
    {
        return $this->hasMany(UserAfterHours::className(), ['hour_id' => 'id']);
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
