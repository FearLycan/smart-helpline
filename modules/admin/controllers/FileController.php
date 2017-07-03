<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\Controller;
use app\modules\admin\models\Category;
use app\modules\admin\models\forms\FileForm;
use Yii;
use app\modules\admin\models\File;
use app\modules\admin\models\FileSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
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
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
        $query = File::find();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $category = Category::findOne($id);
        $model = new FileForm();
        $model->category_id = $id;
        $model->scenario = FileForm::SCENARIO_CREATE;

        if (Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstances($model, 'files');
            if ($model->upload()) {
                return $this->redirect(['category/view', 'id' => $id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'category' => $category,
            ]);
        }
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        unlink(Yii::getAlias('@app/web/files/' . $model->real_name));

        $model->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate($id)
    {
        $model = FileForm::findOne($id);
        $model->scenario = FileForm::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return $this
     * @throws NotFoundHttpException
     */
    public function actionDownload($id)
    {
        $model = $this->findModel($id);

        $path = Yii::getAlias('@app/web/files/' . $model->real_name);

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path, $model->name . '.' . $model->format);
        }

        return 0;
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
