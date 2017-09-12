<?php

namespace app\models;

use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $author_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $shortDescription
 *
 * @property User $author
 *
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['author_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'author_id' => 'Author id',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
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
        return $this->hasMany(UserCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return Html::encode(StringHelper::truncate(strip_tags($this->description), 85, ' [...]'));
    }
}
