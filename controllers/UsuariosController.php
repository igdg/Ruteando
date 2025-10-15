<?php

namespace app\controllers;

use app\models\Rutas;
use Yii;
use app\models\Usuarios;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'index', 'delete', 'activar', 'desactivar', 'view', 'update'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'delete', 'activar', 'desactivar'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['view', 'update'],
                        'allow' => true,
                        'roles' => ['usuario'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Usuarios::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if($id==Yii::$app->user->id || Yii::$app->user->can('actualizarRuta')){
            $rutas = $this->findModel($id)->rutas;

            return $this->render('view', [
                'model' => $this->findModel($id),
                'rutas' => $rutas,
            ]);
        }else{
            throw new ForbiddenHttpException('Acceso denegado');
        }
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();

        if($model->load(Yii::$app->request->post())){
            $model->pass='a';
            $model->password=Yii::$app->request->post('password');

            if($model->save()){
                // the following three lines were added:
                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('usuario');
                $auth->assign($authorRole, $model->id);
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($id==Yii::$app->user->id || Yii::$app->user->can('actualizarRuta')){
            if ($model->load(Yii::$app->request->post())) {
                $model->pass = 'a';
                $model->password = Yii::$app->request->post('password');
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException('Acceso denegado');
        }
    }

    /**
     * Deletes an existing Usuarios model.
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
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDesactivar($id)
    {
        $model = $this->findModel($id);
        if($model->status==Usuarios::STATUS_ACTIVE){
            $model->status=Usuarios::STATUS_DELETED;
            $model->pass='a';

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        throw new Exception('Se ha producido un error', 500);
    }

    public function actionActivar($id)
    {
        $model = $this->findModel($id);
        if($model->status==Usuarios::STATUS_DELETED){
            $model->status=Usuarios::STATUS_ACTIVE;
            $model->pass='a';
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        throw new Exception('Se ha producido un error', 500);
    }
}
