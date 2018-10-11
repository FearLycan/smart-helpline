<?php
/**
 * Created by PhpStorm.
 * User: Damian Brończyk
 * Date: 11.10.2018
 * Time: 12:58
 */

namespace app\controllers;

use app\components\AccessControl;
use app\models\Airline;
use app\models\User;
use app\models\UserAfterHours;
use app\models\UserAirline;
use app\modules\admin\models\AirlineSearch;
use Yii;
use app\models\AfterHours;
use app\models\AfterHoursSearch;
use app\components\Controller;
use yii\web\NotFoundHttpException;

class AirlineController extends Controller
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
            ->joinWith('userAirlines airline')
            ->where(['airline.user_id' => Yii::$app->user->identity->id]);


        $searchModel = new AirlineSearch();
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
        $can = UserAirline::find()
            ->where(['airline_id' => $id, 'user_id' => Yii::$app->user->identity->id])
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
        if (($model = Airline::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}