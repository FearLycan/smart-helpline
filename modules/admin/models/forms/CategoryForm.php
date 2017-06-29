<?php


namespace app\modules\admin\models\forms;
use app\modules\admin\models\Category;

/**
 * CategoryForm model for admin panel.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class CategoryForm extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string'],
            [['name'], 'required'],
        ];
    }
}