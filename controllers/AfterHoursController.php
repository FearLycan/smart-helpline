<?php

namespace app\controllers;

use app\components\AccessControl;
use app\models\User;
use app\models\UserAfterHours;
use Yii;
use app\models\AfterHours;
use app\models\AfterHoursSearch;
use app\components\Controller;
use yii\web\NotFoundHttpException;

/**
 * AfterHoursController implements the CRUD actions for AfterHours model.
 */
class AfterHoursController extends Controller
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

    /**
     * Lists all AfterHours models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = AfterHours::find()
            ->joinWith('linkedUsers hour')
            ->where(['hour.user_id' => Yii::$app->user->identity->id]);


        $searchModel = new AfterHoursSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AfterHours model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $can = UserAfterHours::find()
            ->where(['hour_id' => $id, 'user_id' => Yii::$app->user->identity->id])
        ->one();

        if(empty($can)){
            $this->accessDenied();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the AfterHours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AfterHours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AfterHours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
