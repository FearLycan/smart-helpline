<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\File;
use Yii;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

class FileForm extends File
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $files;
    public $category_id;
    public $contract_id;
    public $folder_id;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false,
                'extensions' => 'png, jpg, jpeg, doc, docx, excel, pdf, txt, xlsx, xls',
                'maxFiles' => 10, 'on' => static::SCENARIO_CREATE,
                'maxSize' => 5 * 1024 * 1024, 'tooBig' => 'Limit is 5MB'
            ],
            [['description'], 'string', 'on' => static::SCENARIO_UPDATE],
            [['name'], 'string', 'on' => static::SCENARIO_UPDATE],
            [['name'], 'required', 'on' => static::SCENARIO_UPDATE],
            [['category_id', 'contract_id', 'folder_id'], 'integer'],
            [['category_id', 'contract_id', 'folder_id'], 'required', 'on' => static::SCENARIO_CREATE]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'files' => 'Choose files for upload',
        ]);
    }

    public function upload()
    {

        if ($this->validate()) {
            foreach ($this->files as $file) {

                $f = new File();

                $name = $file->baseName;
                $real_name = Yii::$app->security->generateRandomString() . '-' . $name;
                $real_name = Inflector::slug($real_name) . '.' . $file->extension;
                $file->saveAs('files/' . $real_name);

                $f->name = $name;
                $f->real_name = $real_name;
                $f->category_id = $this->category_id;
                $f->contract_id = $this->contract_id;
                $f->folder_id = $this->folder_id;
                $f->format = $file->extension;
                $f->save();

                unset($f);

            }
            return true;
        } else {
            return false;
        }
    }

    public function handlerUpload()
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        if ($this->upload()) {
            if ($this->contract_id != 0) {
                return Yii::$app->response->redirect(Url::to(['contract/view', 'id' => $this->contract_id]));
            } elseif ($this->category_id != 0) {
                return Yii::$app->response->redirect(Url::to(['category/view', 'id' => $this->category_id]));
            } elseif ($this->folder_id != 0) {
                return Yii::$app->response->redirect(Url::to(['folder/view', 'id' => $this->folder_id]));
            }
        }
    }
}