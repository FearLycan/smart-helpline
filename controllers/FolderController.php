<?php
/**
 * Created by PhpStorm.
 * User: Damian Brończyk
 * Date: 24.10.2018
 * Time: 14:08
 */

namespace app\controllers;

use app\components\AccessControl;
use app\components\Controller;
use app\models\Category;
use app\models\File;
use app\models\FileSearch;
use app\models\Folder;
use app\models\FolderCategory;
use app\models\searches\FolderSearch;
use app\models\User;
use stdClass;
use Yii;
use yii\web\NotFoundHttpException;


class FolderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'statuses' => [
                            User::STATUS_ACTIVE,
                            User::STATUS_BAN,
                        ],
                    ],
                ],
            ],
        ];
    }

    public function actionView($id, $cid, $fid)
    {
        $category = Category::findOne($cid);

        if (!empty($category)) {
            $con = FolderCategory::find()->where(['category_id' => $cid, 'folder_id' => $fid])->one();

            if (empty($con)) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }


        $folder = Folder::findOne($fid);

        if (empty($folder)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            $fid = $folder->id;
        }

        $searchModel = new FolderSearch();
        $query = Folder::find()->where(['parent_id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        $searchFileModel = new FileSearch();
        $query = File::find()->where(['folder_id' => $id]);
        $dataFileProvider = $searchFileModel->search(Yii::$app->request->queryParams, $query);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'category' => $category,
            'folder' => $folder,
            'fid' => $fid,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'dataFileProvider' => $dataFileProvider,
            'searchFileModel' => $searchFileModel,
        ]);
    }

    /**
     * Finds the Folder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Folder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Folder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}