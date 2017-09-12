<?php


namespace app\modules\admin\components;

use app\modules\admin\models\Category;
use app\modules\admin\models\File;
use yii\helpers\Html;

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
                    return Html::a($data->author->lastname . ' ' . $data->author->name, ['user/view', 'id' => $data->author_id]);
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
        return [
            //'menubar' => false,
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code",
                "insertdatetime media table paste",
                "emoticons paste textcolor colorpicker textpattern imagetools codesample toc help"
            ],

            'content_css' => [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css',
            ],
            'toolbar' => "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor emoticons"
        ];
    }
}