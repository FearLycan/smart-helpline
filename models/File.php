<?php

namespace app\models;

use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property int $id
 * @property string $name
 * @property string $real_name
 * @property string $format
 * @property int $category_id
 * @property int $author_id
 * @property int $contract_id
 * @property int $folder_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $description
 *
 * @property User $author
 * @property Category $category
 * @property Folder $folder
 * @property Contract $contract
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
            [['category_id', 'author_id', 'contract_id', 'folder_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'real_name', 'format', 'description'], 'string', 'max' => 255],
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
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'description' => 'File description',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'folder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContract()
    {
        return $this->hasOne(Contract::className(), ['id' => 'contract_id']);
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return Html::encode(StringHelper::truncate($this->description, 70, ' [...]'));
    }

    /**
     * @return bool
     */
    public function hasContract()
    {
        return !empty($this->contract_id);
    }

    public static function formats()
    {
        return ['doc', 'docx', 'xlsx', 'xls'];
    }
}
