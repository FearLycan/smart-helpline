<?php

namespace app\controllers;


use app\components\AccessControl;
use app\components\Controller;
use app\models\Contract;
use app\models\ContractSearch;
use app\models\File;
use app\models\User;
use app\models\UserContract;
use Yii;
use yii\web\NotFoundHttpException;

class ContractController extends Controller
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
     * Lists all Contract models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Contract::find()
            ->joinWith('linkedUsers cat')
            ->where(['cat.user_id' => Yii::$app->user->identity->id]);


        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

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
        $can = UserContract::find()
            ->where(['contract_id' => $id, 'user_id' => Yii::$app->user->identity->id])
            ->one();

        if(empty($can)){
            $this->accessDenied();
        }


        $files = File::find()
            ->where(['contract_id' => $id])
            ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'files' => $files
        ]);
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
        if (($model = Contract::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}