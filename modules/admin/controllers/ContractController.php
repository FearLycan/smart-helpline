<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\Controller;
use app\modules\admin\models\File;
use app\modules\admin\models\FileSearch;
use app\modules\admin\models\forms\ContractForm;
use app\modules\admin\models\forms\QuickUserForm;
use app\modules\admin\models\User;
use app\modules\admin\models\UserContract;
use Yii;
use app\modules\admin\models\Contract;
use app\modules\admin\models\ContractSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractController implements the CRUD actions for Contract model.
 */
class ContractController extends Controller
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
     * Lists all Contract models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contract model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $files = File::find()
            ->where(['contract_id' => $id])
            ->all();

        $users = ArrayHelper::map(User::find()->select(['id', new \yii\db\Expression("CONCAT(`name`, ' ', `lastname`) as name")])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');

        $quickUserForm = new QuickUserForm();

        $us = UserContract::find()->where(['contract_id' => $id])->all();

        $tab = [];
        foreach ($us as $u) {
            array_push($tab, $u->user->id);
        }

        $quickUserForm->users = $tab;

        if ($quickUserForm->load(Yii::$app->request->post())) {

            if ($quickUserForm->users != $tab) {
                UserContract::makeConnection($quickUserForm->users, $id);
            }

            return $this->redirect(['contract/view', 'id' => $id]);
        }

        $searchModel = new FileSearch();
        $query = File::find()->where(['contract_id' => $id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('view', [
            'model' => $model,
            'files' => $files,
            'users' => $users,
            'quickUserForm' => $quickUserForm,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Creates a new Contract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContractForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Contract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$model->scenario = ContractForm::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contract model.
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
     * Finds the Contract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContractForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
