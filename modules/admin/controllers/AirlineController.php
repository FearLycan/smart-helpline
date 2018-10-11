<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\forms\AirlineForm;
use app\modules\admin\models\forms\QuickUserForm;
use app\modules\admin\models\User;
use app\modules\admin\models\UserAirline;
use Yii;
use app\modules\admin\models\AirlineSearch;
use app\modules\admin\models\Airline;
use app\modules\admin\components\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AirlineController implements the CRUD actions for Airline model.
 */
class AirlineController extends Controller
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
     * Lists all Airline models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AirlineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Airline model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $users = ArrayHelper::map(User::find()->select(['id', new \yii\db\Expression("CONCAT(`name`, ' ', `lastname`) as name")])->orderBy(['name' => SORT_ASC])->all(), 'id', 'name');

        $quickUserForm = new QuickUserForm();

        $us = UserAirline::find()->where(['airline_id' => $id])->all();

        $tab = [];
        foreach ($us as $u) {
            array_push($tab, $u->user->id);
        }

        $quickUserForm->users = $tab;

        if ($quickUserForm->load(Yii::$app->request->post())) {

            if ($quickUserForm->users != $tab) {
                Airline::makeConnection($quickUserForm->users, $id);
            }

            return $this->redirect(['view', 'id' => $id]);
        }


        return $this->render('view', [
            'model' => $this->findModel($id),
            'users' => $users,
            'quickUserForm' => $quickUserForm,
        ]);
















        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Airline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AirlineForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Airline model.
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
     * Deletes an existing Airline model.
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
     * Finds the Airline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Airline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Airline::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
