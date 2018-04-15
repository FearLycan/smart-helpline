<?php

namespace app\modules\admin\models;

/**
 * This is the model class for table "{{%user_category}}"
 */
class UserCategory extends \app\models\UserCategory
{
    /**
     * @param $user_id
     */
    public static function deleteAllCategories($user_id)
    {
        $categories = UserCategory::find()->where(['user_id' => $user_id])->all();

        foreach ($categories as $category) {
            $category->delete();
        }
    }

    public static function makeConnection($users, $category_id)
    {
        $categories = self::find()->where(['category_id' => $category_id])->all();

        foreach ($categories as $category) {
            $category->delete();
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                $con = new UserCategory();
                $con->category_id = $category_id;
                $con->user_id = $user;
                $con->save();

                unset($con);
            }
        }
    }
}
