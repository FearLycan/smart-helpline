<?php


namespace app\modules\admin\models\forms;


use app\modules\admin\models\File;
use Yii;

class FileForm extends File
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $files;
    public $category_id;
    public $contract_id;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false,
                'extensions' => 'png, jpg, jpeg, doc, docx, excel, pdf, txt, xlsx, xls',
                'maxFiles' => 10, 'on' => static::SCENARIO_CREATE,
            ],
            [['description'], 'string', 'on' => static::SCENARIO_UPDATE],
            [['name'], 'string', 'on' => static::SCENARIO_UPDATE],
            [['name'], 'required', 'on' => static::SCENARIO_UPDATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'files' => 'Wybierz pliki do przesłania',
        ]);
    }

    public function upload()
    {

        if ($this->validate()) {
            foreach ($this->files as $file) {

                $f = new File();

                $name = $file->baseName;
                $real_name = Yii::$app->security->generateRandomString() . '-' . $name . '.' . $file->extension;

                $file->saveAs('files/' . $real_name);

                $f->name = $name;
                $f->real_name = $real_name;
                $f->category_id = $this->category_id;
                $f->contract_id = $this->contract_id;
                $f->format = $file->extension;
                $f->save();

                unset($f);

            }
            return true;
        } else {
            return false;
        }
    }
}