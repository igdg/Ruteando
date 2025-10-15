<?php

namespace app\controllers;

use app\models\Usuarios;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use app\models\Rutas;

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
                'only' => ['logout', 'about', 'admin'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['about', 'admin'],
                        'allow' => true,
                        'roles' => ['admin'],
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
                'backColor' => 0x000000,
                'foreColor' => 0xFFFFFF,
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
        $rutas = Rutas::find()->where(['status' => Rutas::STATUS_ACTIVE])->orderBy('id desc')->limit(4)->all();  //4 últimas rutas
        $mejoresRutas = Rutas::find()->where(['status' => Rutas::STATUS_ACTIVE])->orderBy("puntuacion desc")->limit(3)->all();   //3 mejores rutas


        return $this->render('index', [
            'rutas' => $rutas,
            'mejoresRutas' => $mejoresRutas,
        ]);


    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect(Yii::$app->request->baseUrl.'?r=rutas/todas');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAdmin()
    {
        $rutas =  Rutas::find()->where(['status'=>0])->orderBy('fecha desc')->all();
        $rutasActivas = Rutas::find()->where(['status'=>1])->orderBy('fecha desc')->all();
        $usuarios = Usuarios::find()->where(['status'=>0])->all();
        $usuariosActivos = Usuarios::find()->where(['status'=>10])->all();

        return $this->render('admin', [
            'rutas' => $rutas,
            'rutasActivas' => $rutasActivas,
            'usuarios' => $usuarios,
            'usuariosActivos' => $usuariosActivos,
        ]);
    }
}
