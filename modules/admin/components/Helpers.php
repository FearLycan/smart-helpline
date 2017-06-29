<?php


namespace app\modules\admin\components;
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
                    return Html::a($data->name, ['file/download', 'id' => $data->id], [
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
                'label' => 'Kategoria',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $data File */
                    return Html::a($data->category->name, ['category/view', 'id' => $data->category_id]);
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'Autor',
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
                    return Html::a('Usuń', ['file/delete', 'id' => $data->id], [
                        'class' => 'btn btn-danger btn-xs',
                        'data-pjax' => '0',
                        'data-confirm' => 'Czy na pewno usunąć ten element?',
                        'data-method' => 'post',
                    ]);
                },
            ]
        ];
    }
}