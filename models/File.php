<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property int $id
 * @property string $name
 * @property string $real_name
 * @property string $format
 * @property int $category_id
 * @property int $author_id
 * @property string $created_at
 *
 * @property User $author
 *
 * * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'author_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'real_name', 'format'], 'string', 'max' => 255],
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
            'real_name' => 'Real Name',
            'format' => 'Format',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
