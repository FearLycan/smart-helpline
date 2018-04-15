<?php


namespace app\modules\admin\components;

use app\modules\admin\models\Category;
use app\modules\admin\models\File;
use yii\helpers\Html;
use yii\web\JsExpression;

/**
 * General app helper.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class Helpers
{
    public static function getColumnsFileGride()
    {
        return [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data File */
                    return Html::a($data->name, ['file/view', 'id' => $data->id], [
                        'data-pjax' => '0'
                    ]);
                },
            ],
            [
                'attribute' => 'format',
                'contentOptions' => ['style' => 'width: 100px; text-align: center'],
            ],
            [
                'attribute' => 'category',
                'label' => 'Category',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data File */
                    if ($data->category_id != 0) {
                        return Html::a($data->category->name, ['category/view', 'id' => $data->category_id]);
                    } else {
                        return Html::a('Contract', ['contract/view', 'id' => $data->contract_id]);
                    }
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'Author',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data File */
                    return Html::a($data->author->name . ' ' . $data->author->lastname, ['user/view', 'id' => $data->author_id]);
                },
            ],
            'created_at',
            [
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data File */
                    return Html::a('Edit', ['file/update', 'id' => $data->id], [
                        'class' => 'btn btn-primary btn-xs',
                        'data-pjax' => '0',
                    ]);
                },
            ],
            [
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data File */
                    return Html::a('Download', ['file/download', 'id' => $data->id], [
                        'class' => 'btn btn-success btn-xs',
                        'data-pjax' => '0',
                    ]);
                },
            ],
            [
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data File */
                    return Html::a('Delete', ['file/delete', 'id' => $data->id], [
                        'class' => 'btn btn-danger btn-xs',
                        'data-pjax' => '0',
                        'data-confirm' => 'Are you sure you want to delete this item?',
                        'data-method' => 'post',
                    ]);
                },
            ],
        ];
    }

    public static function getColumnsCategoryGride()
    {
        return [
            [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'author',
                    'label' => 'Author',
                    'value' => function ($data) {
                        /* @var $data Category */
                        return $data->author->lastname . ' ' . $data->author->name;
                    },
                ],
                'created_at',
                ['class' => 'yii\grid\ActionColumn'],
            ]
        ];
    }

    public static function getTinyMceOptions()
    {
        /*return [
            //'menubar' => false,
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code",
                "insertdatetime media table paste image imagetools",
                "emoticons paste textcolor colorpicker textpattern imagetools codesample toc help",
                "image imagetools"
            ],

            'content_css' => [
                // '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css',
            ],
            'toolbar' => "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor emoticons"
        ];*/

        return [
            'theme' => 'modern',
            'skin' => 'lightgray',
            'content_css' => [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css',
            ],
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste",
                "image imagetools visualchars textcolor",
                "autosave colorpicker hr nonbreaking"
            ],
            'toolbar1' => "undo redo | styleselect fontselect fontsizeselect forecolor backcolor | bold italic",
            'toolbar2' => "alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            //'image_advtab' => true,
            /*'templates' => [
                ['title' => 'Test template 1', 'content' => 'Test 1'],
                ['title' => 'Test template 2', 'content' => 'Test 2']
            ],*/
            //'visualblocks_default_state' => true,
            //'image_title' => true,
            //'images_upload_url' => 'postAcceptor.php',
            // here we add custom filepicker only to Image dialog
            'file_picker_types' => 'image',
            // and here's our custom image picker
            'file_picker_callback' => new JsExpression("function(cb, value, meta) {
 var input = document.createElement('input');
 input.setAttribute('type', 'file');
 input.setAttribute('accept', 'image/*');
 
 // Note: In modern browsers input[type=\"file\"] is functional without 
 // even adding it to the DOM, but that might not be the case in some older
 // or quirky browsers like IE, so you might want to add it to the DOM
 // just in case, and visually hide it. And do not forget do remove it
 // once you do not need it anymore.

 input.onchange = function() {
   var file = this.files[0];
   
   var reader = new FileReader();
   reader.onload = function () {
     // Note: Now we need to register the blob in TinyMCEs image blob
     // registry. In the next release this part hopefully won't be
     // necessary, as we are looking to handle it internally.
     var id = 'blobid' + (new Date()).getTime();
     var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
     var base64 = reader.result.split(',')[1];
     var blobInfo = blobCache.create(id, file, base64);
     blobCache.add(blobInfo);

     // call the callback and populate the Title field with the file name
     cb(blobInfo.blobUri(), { title: file.name });
   };
   reader.readAsDataURL(file);
 };
 
 input.click();
}"),
        ];
    }

    public static function checkString($string)
    {
        //sprawdzenie czy html zawiera tabelę
        if (strpos($string, '<table>') !== false) {
            $string = str_replace('<table>', '<table class="table table-bordered table-striped">', $string);
        }

        return $string;
    }

}