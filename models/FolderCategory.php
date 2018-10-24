<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%folder_category}}".
 *
 * @property int $folder_id
 * @property int $category_id
 *
 * @property Category $category
 * @property Folder $folder
 */
class FolderCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%folder_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['folder_id', 'category_id'], 'required'],
            [['folder_id', 'category_id'], 'integer'],
            [['folder_id', 'category_id'], 'unique', 'targetAttribute' => ['folder_id', 'category_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['folder_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'folder_id' => 'Folder ID',
            'category_id' => 'Category ID',
        ];
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
}
