<?php

namespace app\modules\admin\models;

class FolderCategory extends \app\models\FolderCategory
{
    public static function connectCategoriesToFolder($categories, $folder_id)
    {
        FolderCategory::deleteAll(['folder_id' => $folder_id]);

        foreach ($categories as $category_id) {
            $connect = new FolderCategory();
            $connect->category_id = $category_id;
            $connect->folder_id = $folder_id;

            $connect->save();

            unset($connect);
        }
    }

    public static function connectFoldersToCategory($folders, $category_id)
    {
        FolderCategory::deleteAll(['category_id' => $category_id]);

        foreach ($folders as $folder_id) {
            $connect = new FolderCategory();
            $connect->category_id = $category_id;
            $connect->folder_id = $folder_id;

            $connect->save();

            unset($connect);
        }
    }
}
