<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Category;
use app\modules\admin\models\File;
use app\modules\admin\models\FileSearch;
use app\modules\admin\models\FolderCategory;
use app\modules\admin\models\forms\FileForm;
use app\modules\admin\models\forms\FolderForm;
use app\modules\admin\models\forms\QuickCategoryFolderForm;
use Yii;
use app\modules\admin\models\Folder;
use app\modules\admin\models\searches\FolderSearch;
use app\modules\admin\components\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FolderController implements the CRUD actions for Folder model.
 */
class FolderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Folder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FolderSearch();
        $query = Folder::find()->where(['parent_id' => Folder::BASE_FOLDER]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        $form = new FolderForm();

        if ($form->load(Yii::$app->request->post())) {
            $form->parent_id = Folder::BASE_FOLDER;
            $form->save();

            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'form' => $form,
        ]);
    }

    /**
     * Displays a single Folder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new FolderSearch();
        $query = Folder::find()->where(['parent_id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        $searchFileModel = new FileSearch();
        $query = File::find()->where(['folder_id' => $id]);
        $dataFileProvider = $searchFileModel->search(Yii::$app->request->queryParams, $query);

        $form_folder = new FolderForm();

        if ($form_folder->load(Yii::$app->request->post())) {
            $form_folder->parent_id = $id;
            $form_folder->save();

            return $this->redirect(['view', 'id' => $id]);
        }

        $form_file = new FileForm();
        $form_file->scenario = FileForm::SCENARIO_CREATE;

        if ($form_file->load(Yii::$app->request->post())) {
            $form_file->category_id = 0;
            $form_file->contract_id = 0;
            $form_file->folder_id = $id;

            $form_file->handlerUpload();
        }

        $quickCategoryFolderForm = new QuickCategoryFolderForm();
        $categories = ArrayHelper::map(Category::find()->select(['id', 'name'])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');

        $cats = FolderCategory::find()->where(['folder_id' => $id])->select(['category_id'])->all();
        $tab = [];
        foreach ($cats as $cat) {
            array_push($tab, $cat->category_id);
        }

        $quickCategoryFolderForm->categories = $tab;

        if ($quickCategoryFolderForm->load(Yii::$app->request->post())) {
            if ($quickCategoryFolderForm->categories != $tab) {
                FolderCategory::connectCategoriesToFolder($quickCategoryFolderForm->categories, $id);
            }

            return $this->redirect(['folder/view', 'id' => $id]);
        }


        return $this->render('view', [
            'model' => $this->findModel($id),
            'form_folder' => $form_folder,
            'form_file' => $form_file,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'dataFileProvider' => $dataFileProvider,
            'searchFileModel' => $searchFileModel,
            'quickCategoryFolderForm' => $quickCategoryFolderForm,
            'categories' => $categories,
        ]);
    }

    /**
     * Creates a new Folder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Folder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Folder model.
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
     * Deletes an existing Folder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $f = null)
    {
        $this->findModel($id)->delete();

        if ($f != null) {
            return $this->redirect(['index']);
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
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
