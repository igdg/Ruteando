<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\themes\nacho\assets\AppAsset;
use yii\widgets\LinkPager;
use app\models\Rutas;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\gallery\Gallery;

/* @var $this yii\web\View */
/* @var $model app\models\Rutas */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Rutas', 'url' => ['todas']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
$this->registerJsFile(Yii::getAlias('@web') . '/js/dibujarMapa.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs('var rutaPath="' . $rutaPath . '";', \yii\web\View::POS_BEGIN);
?>
<!--<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG3FzyST96Ql_7YzQ_K4gjvf60mX84sMQ&libraries=geometry"
        async defer></script>-->
<style>
    /*-- SPAN NEGRITA--*/
    span.label {
        font-size: 1em;
    }

</style>

<div class="col-lg-12">
    <?php if(Yii::$app->session->hasFlash('voto')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('voto') ?>
        </div>
    <?php endif; ?>
</div>

<div class="rutas-view">

    <div class="panel-body">
        <div class="col-lg-12 container">
            <h1 class="text-center" id="idTituloRuta""><?= $model->nombre ?></h1>
            <?php
            $usuario = $model->getUsuario()->all();
            ?>
            <div class="col-lg-12">
                <span>Ruta creada por: <span class="usuario"><?= $usuario[0]->nombre ?></span></span>
                <span class="fecha"><?= Rutas::formatoFecha($model->fecha); ?></span>
                <hr>
            </div>

            <!-- BOTÓN DE ACTIVAR RUTA -->
            <?php
            if (Yii::$app->user->can('actualizarRuta')) {
                if ($model->status == 0) {
                    echo "<button class='btn btn-primary' id='activar' data-url='" . Yii::$app->request->baseUrl . "?r=rutas/activar" . "' data-id='id=" . $model->id . "'>Activar</button>";
                }
                ?>

                <!-- BOTÓN DE ELIMINAR RUTA -->
                <a href="<?php echo Url::to(['rutas/delete', 'id' => $model->id]) ?>" class="btn btn-danger"
                   data-method="post" data-confirm="¿Estás seguro de borrar esta ruta?">Eliminar ruta</a>
                <?php
            }
            ?>


            <!-- DESCRIPCIÓN Y MAPA -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- DESCRIPCIÓN DE LA RUTA -->
                    <div class="col-sm-12 col-lg-6" id="descripcionRuta">
                        <h2 class="text-center">Descripción</h2>
                        <p><?= $model->descripcion ?></p>
                    </div>

                    <!-- MAPA DE LA RUTA -->
                    <div class="col-sm-12 col-lg-6 text-center">
                        <h2>Mapa de la ruta</h2>
                        <div id="map1" onload="initialize(<?php echo $model->id ?>)"></div>
                        <?php
                        ?>
                    </div>
                </div>
            </div>


            <!-- DATOS DE LA RUTA -->
            <div class="row margenInferior">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="text-center">Datos de la ruta</h2>

                    <div class="row text-center">

                        <span class="margenDatos">
                            <span class="negrita">Tipo de ruta:</span>
                            <?php
                            if ($model->tipo == "Andando") {
                                echo "<span class='tipo'><img class='imgIconos' src='imagenes/iconos/tipo-ruta/Andando.svg'/></span>";
                            } else if ($model->tipo == "Bicicleta") {
                                echo "<span class='tipo'><img class='imgIconos' src='imagenes/iconos/tipo-ruta/Bicicleta.svg'/></span>";
                            } else if ($model->tipo == "Coche") {
                                echo "<span class='tipo'><img class='imgIconos' src='imagenes/iconos/tipo-ruta/Coche.svg'/></span>";
                            } else {
                                echo "<span class='tipo'><img class='imgIconos' src='imagenes/iconos/tipo-ruta/Moto.svg'/></span>";
                            }
                            ?>
                        </span>


                        <span class="margenDatos">
                            <span class="negrita">Dificultad:</span>
                            <?php
                            if ($model->dificultad == 'Principiante' || $model->dificultad == 'Facil') {
                                echo "<span class='label label-success'>$model->dificultad</span>";
                            } else if ($model->dificultad == 'Intermedio') {
                                echo "<span class='label label-warning'>$model->dificultad</span>";
                            } else {
                                echo "<span class='label label-danger'>$model->dificultad</span>";
                            }
                            ?>
                        </span>

                        <span class="margenDatos">
                            <span class="negrita">Distancia:</span>
                            <span id="distRuta"></span>
                        </span>
                    </div>
                </div>
            </div>


            <!-- FOTOGRAFÍAS -->
            <div class="row text-center">
                <?php
                $fotos = $model->fotosRutas;
                if ($fotos) {
                    echo "<h2 class='text-center'>Fotografías</h2>";
                    foreach ($fotos as $k => $foto) {
                        $items[] = array('url' => 'imgRutas/' . $foto->id_ruta . '/' . $foto->id . '.jpg', 'src' => 'imgRutas/' . $foto->id_ruta . '/' . $foto->id . '.jpg', 'imageOptions' => array('style' => 'width:180px; height:120px;'));
                    }
                    echo Gallery::widget(['items' => $items]);
                }
                ?>
            </div>


        </div>

        <!-- PUNTUACIÓN -->
        <div class="col-lg-6" id="divPuntuacion">
            <a href="#" id="positivo" name="positivo" data-id="<?= $model->id ?>"
               data-url="<?php echo Yii::$app->request->baseUrl . '?r=rutas/votar' ?>"><img class='imgIconos'
                                                                                            src="imagenes/iconos/votos/positivo.svg"
                                                                                            alt="voto positivo"/></a>
            <a href="#" id="negativo" name="negativo" data-id="<?= $model->id ?>"
               data-url="<?php echo Yii::$app->request->baseUrl . '?r=rutas/votar' ?>"><img class='imgIconos'
                                                                                            src="imagenes/iconos/votos/negativo.svg"
                                                                                            alt="voto negativo"/></a>

            <?php
            if ($model->puntuacion > 0) {
                echo "<span class='verde puntuacion'>Puntuación: " . $model->puntuacion . "</span>";
            } else {
                echo "<span class='rojo puntuacion'>Puntuación: " . $model->puntuacion . "</span>";
            }
            ?>

        </div>

        <!-- COMENTARIOS -->
        <div class="col-lg-12">
            <h2 id="idTituloComentarios">Comentarios</h2>
            <div id="comentarios">
                <?php
                //AQUI VAN LOS COMENTARIOS DE LA RUTA
                foreach ($comentarios as $k => $comentario) {
                    echo "<div class='comentario'>";
                    $usuario = $comentario->getUsuario()->all();
                    echo "<hr>";
                    echo "<span class='uComentario'>" . $usuario[0]->nombre . "</span>";
                    ?>
                    <!-- BOTÓN DE ELIMINAR RUTA -->
                    <?php
                    if (Yii::$app->user->can('actualizarRuta')) {
                        ?>
                        <a href="<?php echo Url::to(['comentarios/modify', 'id' => $comentario->id]) ?>"
                           data-method="post" data-confirm="¿Estás seguro de borrar el comentario?">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                        <?php
                    }
                    ?>

                    <?php
                    echo "<p class='fecha'>" . Rutas::formatoFechaHora($comentario->fecha_hora) . "</p>";
                    echo "<p class='cComentario'>$comentario->comentario</p>";
                    echo "</div>";
                }
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
            <div class="col-lg-6">
                <textarea name="comentarios" id="comentario" cols="30" rows="10" class="form-control" maxlength="150"
                          placeholder="Introduce tu comentario aquí"></textarea>
            </div>

            <div class="col-lg-12">
                <button id="btn-cmt" class="btn btn-default" data-rol="<?= Yii::$app->user->isGuest ?>"
                        data-id="<?= $model->id ?>" data-user="<?= Yii::$app->user->id ?>"
                        data-url="<?= Yii::$app->request->baseUrl . '?r=rutas/comentar' ?>">Enviar comentario
                </button>
            </div>
        </div>
    </div>
</div>
</div>