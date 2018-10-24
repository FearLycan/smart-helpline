<?php

namespace app\models;

use app\modules\admin\components\AuthorBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%folder}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $parent_id
 * @property int $author_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $author
 */
class Folder extends ActiveRecord
{
    const BASE_FOLDER = 0;


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
        return '{{%folder}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'author_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
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
            'parent_id' => 'Parent ID',
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

    public function getParents($fid = null)
    {
        $n = true;
        $parents = [];

        $parent_id = $this->parent_id;

        while ($n) {
            $folder = Folder::find()->where(['id' => $parent_id])->one();

            if (!empty($folder)) {
                $parents[] = [
                    'id' => $folder->id,
                    'name' => $folder->name,
                ];

                if ($folder->parent_id == static::BASE_FOLDER) {
                    $n = false;
                } else {
                    $parent_id = $folder->parent_id;
                }

            } else {
                $n = false;
            }
        }

        return array_reverse($parents);
    }

    public function getParentsShort($fid = null)
    {
        $n = true;
        $parents = [];

        $parent_id = $this->parent_id;

        if ($this->id == $fid) {
            $n = false;
        }

        while ($n) {
            $folder = Folder::find()->where(['id' => $parent_id])->one();

            if (!empty($folder)) {

                $parents[] = [
                    'id' => $folder->id,
                    'name' => $folder->name,
                ];

                if ($folder->id == $fid) {
                    $n = false;
                } else {
                    $parent_id = $folder->parent_id;
                }
            } else {
                $n = false;
            }
        }

        return array_reverse($parents);
    }

    public static function getSort()
    {
        return [
            ''
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkedCategories()
    {
        return $this->hasMany(FolderCategory::className(), ['folder_id' => 'id']);
    }
}
