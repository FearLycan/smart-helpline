<?php

namespace app\controllers;

use app\components\AccessControl;
use app\models\Category;
use app\models\CategorySearch;
use app\models\File;
use app\models\FileSearch;
use app\models\User;
use Yii;
use app\components\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\forms\LoginForm;

class SiteController extends Controller
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
                        ],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'login',
                        ],
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Category::find()
            ->joinWith('linkedUsers cat')
            ->where(['cat.user_id' => Yii::$app->user->identity->id]);

        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $category = Category::findOne($id);

        $query = File::find()->where(['category_id' => $id]);

        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);

        return $this->render('view', [
            'category' => $category,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return $this
     * @throws NotFoundHttpException
     */
    public function actionDownload($id)
    {
        $model = File::findOne($id);

        if (empty($model) || !Yii::$app->user->identity->canSeeThisCategory($model->category_id)) {
            $this->accessDenied();
        } else {
            $path = Yii::getAlias('@app/web/files/' . $model->real_name);

            if (file_exists($path)) {
                return Yii::$app->response->sendFile($path, $model->name . '.' . $model->format);
            } else {
                $this->notFound();
            }
        }

        return 0;
    }


    /**
     * @return array|string|Response
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            Yii::$app->user->identity->last_login_at = date('Y-m-d H:i:s');
            Yii::$app->user->identity->save(false, ['last_login_at']);

            return $this->goHome();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Action logout current user.
     *
     * @return Response
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        return $this->goHome();
    }
}
