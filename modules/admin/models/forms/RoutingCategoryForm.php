<?php

namespace app\modules\admin\models\forms;

use app\modules\admin\models\RoutingCategory;

/**
 * RoutingCategoryForm model for admin panel.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class RoutingCategoryForm extends RoutingCategory
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