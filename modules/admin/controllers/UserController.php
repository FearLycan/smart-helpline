<?php

namespace app\modules\admin\controllers;

use app\models\UserCategory;
use app\modules\admin\components\Controller;
use app\modules\admin\models\forms\UserForm;
use Yii;
use app\modules\admin\models\User;
use app\modules\admin\models\UserSearch;

use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
        $model = User::findOne($id);

        return $this->render('view', [
            'model' => $model,
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

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            //die(var_dump($model->categories));

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
     * @property UserForm $model
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $copy_password = $model->password;
        $model->password = null;

        $model->categories_list = ArrayHelper::getColumn(UserCategory::find()
            ->where(['user_id' => $id])
            ->select(['category_id'])
            ->asArray()->all(),
            'category_id'
        );

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

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


    public function actionDeleteLinkCategory($user_id, $category_id)
    {
        $link = UserCategory::find()
            ->where(['user_id' => $user_id, 'category_id' => $category_id])
            ->one();

        $link->delete();

        return $this->redirect(Yii::$app->request->referrer);
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
