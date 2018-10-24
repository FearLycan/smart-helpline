<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\Controller;
use app\modules\admin\models\File;
use app\modules\admin\models\FileSearch;
use app\modules\admin\models\Folder;
use app\modules\admin\models\FolderCategory;
use app\modules\admin\models\forms\CategoryForm;
use app\modules\admin\models\forms\QuickFolderCategoryForm;
use app\modules\admin\models\forms\QuickUserForm;
use app\modules\admin\models\User;
use app\modules\admin\models\UserCategory;
use Yii;
use app\modules\admin\models\Category;
use app\modules\admin\models\CategorySearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $query = Category::find();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new FileSearch();
        $query = File::find()->where(['category_id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        $users = ArrayHelper::map(User::find()->select(['id', new \yii\db\Expression("CONCAT(`name`, ' ', `lastname`) as name")])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');

        $quickUserForm = new QuickUserForm();

        $us = UserCategory::find()->where(['category_id' => $id])->all();

        $tab = [];
        foreach ($us as $u) {
            array_push($tab, $u->user->id);
        }

        $quickUserForm->users = $tab;

        if ($quickUserForm->load(Yii::$app->request->post())) {

            if ($quickUserForm->users != $tab) {
                UserCategory::makeConnection($quickUserForm->users, $id);
            }

            return $this->redirect(['category/view', 'id' => $id]);
        }

        $quickFolderCategoryForm = new QuickFolderCategoryForm();
        $folders = ArrayHelper::map(Folder::find()->select(['id', 'name'])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');

        $fols = FolderCategory::find()->where(['category_id' => $id])->select(['folder_id'])->all();
        $tab = [];
        foreach ($fols as $fol) {
            array_push($tab, $fol->folder_id);
        }

        $quickFolderCategoryForm->folders = $tab;

        if ($quickFolderCategoryForm->load(Yii::$app->request->post())) {
            if ($quickFolderCategoryForm->folders != $tab) {
                FolderCategory::connectFoldersToCategory($quickFolderCategoryForm->folders, $id);
            }

            return $this->redirect(['category/view', 'id' => $id]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'quickUserForm' => $quickUserForm,
            'users' => $users,
            'folders' => $folders,
            'quickFolderCategoryForm' => $quickFolderCategoryForm,
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
