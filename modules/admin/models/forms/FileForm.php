<?php


namespace app\modules\admin\models\forms;


use app\modules\admin\models\File;
use Yii;
use yii\web\UploadedFile;

class FileForm extends File
{
    /**
     * @var UploadedFile[]
     */
    public $files;
    public $category_id;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false,
                'extensions' => 'png, jpg, jpeg, doc, docx, excel, pdf, txt, xlsx, xls',
                'maxFiles' => 10
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'files' => 'Wybierz pliki do przesłania',
        ];
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