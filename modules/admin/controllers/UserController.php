<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\Controller;
use app\modules\admin\models\forms\UserForm;
use Yii;
use app\modules\admin\models\User;
use app\modules\admin\models\UserSearch;

use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();
        $model->scenario = UserForm::SCENARIO_CREATE;
        $model->status = User::STATUS_ACTIVE;

        if ($model->load(Yii::$app->request->post())) {

            if ($model->message == UserForm::SEND_MESSAGE) {
                $model->sendEmail();
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $copy_password = $model->password;
        $model->password = null;

        if ($model->load(Yii::$app->request->post())) {

            if ($model->message == UserForm::SEND_MESSAGE) {
                $model->sendEmail();
            }

            if (empty($model->password)) {
                $model->password = $copy_password;
            } else {
                $model->password = $model->hashPassword($model->password);
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUserListJson($phrase, $page = 1)
    {
        $limit = 20;

        $users = User::find()
            ->where(['like', 'name', $phrase])
            ->orWhere(['like', 'lastname', $phrase])
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->all();

        $results = [];
        /* @var $user User */
        foreach ($users as $user) {
            $results[] = [
                'id' => $user->id,
                'name' => $user->name,
                'lastname' => $user->lastname,
            ];
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'results' => $results,
            'pagination' => [
                'page' => $page,
                'more' => count($results) === $limit,
            ],
        ];

    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
