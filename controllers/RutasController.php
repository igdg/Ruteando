<?php
namespace app\controllers;

use app\models\Comentarios;
use app\models\FotosRutas;
use app\models\PuntosControl;
use app\models\UploadForm;
use Yii;
use app\models\Rutas;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\BaseJson;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\Json;


/**
 * RutasController implements the CRUD actions for Rutas model.
 */
class RutasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'index', 'update', 'delete', 'votar', 'activar', 'comentar'],
                'rules' => [
                    [
                        'actions' => ['create', 'votar', 'update', 'comentar'],
                        'allow' => true,
                        'roles' => ['usuario'],
                    ],
                    [
                        'actions' => ['index', 'delete', 'activar', 'desactivar'],
                        'allow' => true,
                        'roles' => ['admin'],
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
     * Lists all Rutas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Rutas::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rutas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->status == 0 && Yii::$app->user->can('actualizarRuta')) {
            $query = Comentarios::find()->where(['id_ruta' => $id]);
            $count = $query->count();
            $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
            $comentarios = $query->offset($pages->offset)->limit($pages->limit)->all();


            return $this->render('view', [
                'model' => $model,
                'comentarios' => $comentarios,
                'pages' => $pages,
                'rutaPath' => Url::to(["rutas/puntos", "id" => $model->id])
            ]);
        } else {
            if ($model->status == 1) {
                $query = Comentarios::find()->where(['id_ruta' => $id]);
                $count = $query->count();
                $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
                $comentarios = $query->offset($pages->offset)->limit($pages->limit)->all();


                return $this->render('view', [
                    'model' => $model,
                    'comentarios' => $comentarios,
                    'pages' => $pages,
                    'rutaPath' => Url::to(["rutas/puntos", "id" => $model->id])
                ]);
            }
        }
        throw new HttpException(500, 'Ha ocurrido un problema');
    }

    /**
     * Creates a new Rutas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $rutas = new Rutas();
        $uploadForm = new UploadForm();
        $uploadForm->imageFiles = UploadedFile::getInstances($uploadForm, 'imageFiles');
        $puntosControl = Yii::$app->request->post('puntos_control');
        preg_match_all("/\-?\d+\.\d+/", $puntosControl, $coincidencias);

        if (count($coincidencias[0]) > 0 && count($coincidencias[0]) % 2 == 0) {
            if ($rutas->load(Yii::$app->request->post()) && $rutas->save()) {
                if ($uploadForm->upload($rutas->id)) {
                    //La foto se ha subido bien.
                    for ($i = 0, $j = 1; $i < count($coincidencias[0]); $i = $i + 2, $j++) {
                        $ObjPuntosControl = new PuntosControl();
                        $latitud = $coincidencias[0][$i];
                        $longitud = $coincidencias[0][$i + 1];
                        //Guardar los datos.
                        $ObjPuntosControl->latitud = $latitud;
                        $ObjPuntosControl->longitud = $longitud;
                        $ObjPuntosControl->id_ruta = $rutas->id;
                        $ObjPuntosControl->orden = $j;
                        $ObjPuntosControl->save();
                    }
                    return $this->redirect(['todas']);
                } else {
                    //No se ha subido bien. Borrar registro.
                    FotosRutas::deleteAll(['id_ruta' => $rutas->id]);
                }
            }

        } else {
            return $this->render('create', [
                'model' => $rutas,
                'model1' => $uploadForm,
            ]);
        }


    }

    /**
     * Updates an existing Rutas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->id_usuario == Yii::$app->user->id || Yii::$app->user->can('actualizarRuta')) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException('Acceso denegado');
        }
    }

    /**
     * Deletes an existing Rutas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['todas']);
    }

    public function actionTodas()
    {
        $query = Rutas::find()->where(['status' => 1]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        $rutas = $query->offset($pagination->offset)->limit($pagination->limit)->where(['status' => 1])->orderBy('fecha desc')->all();

        return $this->render('todas', [
            'rutas' => $rutas,
            'pagination' => $pagination,
        ]);
    }


    //Votos
    public function actionVotar($id, $valor)
    {

        if (Yii::$app->request->cookies->has("voto".$id)) {


            return "no";

        } else {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => "voto".$id,
                'value' => $id,
                'expire' => time() + 86400 * 365,
            ]));

            $model = Rutas::findOne($id);

            if (Yii::$app->request->isAjax) {
                $puntuacion = $model->puntuacion;
                $model->puntuacion = $puntuacion + $valor;
                if ($model->save()) {
                    return $model->puntuacion;
                }
            }
        }

        throw new HttpException(500, 'Ha ocurrido un problema');
    }

    public function actionActivar($id)
    {
        $model = Rutas::findOne($id);

        if ($model->status == 0) {
            $model->status = Rutas::STATUS_ACTIVE;
            if ($model->save()) {
                return $this->redirect(['rutas/view', 'id' => $model->id]);
            }
        }
        throw new HttpException(500, 'Ha ocurrido un problema');
    }

    public function actionDesactivar($id)
    {
        $model = Rutas::findOne($id);

        if ($model->status == 1) {
            $model->status = Rutas::STATUS_INACTIVE;
            if ($model->save()) {
                return $this->redirect(['rutas/view', 'id' => $model->id]);
            }
        }
        throw new HttpException(500, 'Ha ocurrido un problema');
    }


    public function actionComentar($id, $idUser, $comentario)
    {
        if (Yii::$app->request->isAjax) {
            $model = new Comentarios();
            $model->id_ruta = $id;
            $model->id_usuario = $idUser;
            $model->comentario = strip_tags($comentario);
            if ($model->save()) {
                return $this->redirect(['rutas/view', 'id' => $model->id_ruta]);
            }
        }
        throw new HttpException(500, 'Ha ocurrido un problema');
    }

    public function actionOrdenar($columna)
    {
        if (Yii::$app->request->isAjax) {
            $query = Rutas::find();
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
            $rutas = $query->offset($pagination->offset)->limit($pagination->limit)->where(['status' => 1])->orderBy($columna)->all();

            return $this->renderPartial('divRutas', ['rutas' => $rutas, 'pagination' => $pagination,]);
        } else {
            $query = Rutas::find();
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
            $rutas = $query->offset($pagination->offset)->limit($pagination->limit)->where(['status' => 1])->orderBy($columna)->all();
            echo $this->render('todas', ['rutas' => $rutas, 'pagination' => $pagination]);
        }
    }

    public function actionBuscador($nombre)
    {
        if (Yii::$app->request->isAjax) {
            $query = Rutas::find();
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
            if ($nombre == "todas") {
                $rutas = $query->offset($pagination->offset)->limit($pagination->limit)->where(['status' => 1])->all();
            } else {
                $rutas = $query->offset($pagination->offset)->limit($pagination->limit)->where(['like', 'nombre', $nombre])->andWhere(['status' => 1])->all();
            }


            if ($rutas == null) {
                return "null";
            }
            return $this->renderPartial('divRutas', ['rutas' => $rutas, 'pagination' => $pagination]);
        } else {
            $query = Rutas::find();
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
            $rutas = $query->offset($pagination->offset)->limit($pagination->limit)->where(['status' => 1])->all();
            echo $this->render('todas', ['rutas' => $rutas, 'pagination' => $pagination]);
        }
    }

    public function actionPuntos($id)
    {

        $model = $this->findModel($id);
        $puntos = $model->puntosControls;

        $query = new Query;
        $query->select('latitud as lat, longitud as lng')->from('puntos_control')->where(['id_ruta' => $id])->orderBy('orden');
        $rows = $query->all();
        $command = $query->createCommand();
        $rows = $command->queryAll();

        $json = BaseJson::htmlEncode($rows);
        echo $json;
    }

    /**
     * Finds the Rutas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rutas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rutas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
