<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AppAsset;
use yii\widgets\LinkPager;
use app\models\Rutas;

/* @var $this yii\web\View */
/* @var $model app\models\Rutas */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Rutas', 'url' => ['todas']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>
<style>
    /*-- SPAN NEGRITA--*/
    span.negrita {
        font-weight: bold;
    }

    span.verde{
        color: green;
    }

    span.rojo{
        color: darkred;
    }

    img.icono{
        height: 50px;
    }

    img#mapa{
        height: 300px;
    }

    .puntuacion{
        font-size: 2em;
    }

    span.label{
        font-size: 1em;
    }

    span.usuario{
        font-weight: bold;
    }

    .fecha{
        color:darkgray;
    }

    #btn-cmt{
        margin-top: 10px;
    }
</style>

<div class="rutas-view">

    <div class="panel-body">
        <div class="col-lg-12 container">
            <h1 class="text-center"><?= $model->nombre ?></h1>
            <?php
                $usuario = $model->getUsuario()->all();
            ?>
            <div class="col-lg-12">
                <span>Ruta creada por: <span class="usuario"><?=  $usuario[0]->nombre ?></span></span>
                <span class="fecha"><?= Rutas::formatoFecha($model->fecha);  ?></span>
                <hr>
            </div>

<!--            <button class="btn btn-primary" id="activar" name="activar" data-url="--><?//= Yii::$app->request->baseUrl. '?r=rutas/activar' ?><!--" data-id="--><?//= "id=".$model->id ?><!--">Activar</button>-->
            <?php
                if($model->status==0){
                    echo "<button class='btn btn-primary' id='activar' data-url='".Yii::$app->request->baseUrl."?r=rutas/activar"."' data-id='id=". $model->id ."'>Activar</button>";
                }
            ?>

            <!-- DESCRIPCIÓN Y MAPA -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- DESCRIPCIÓN DE LA RUTA -->
                    <div class="col-sm-12 col-lg-6">
                        <h2 class="text-center">Descripción</h2>
                        <?= $model->descripcion ?>
                    </div>
                    <!--                <div class="col-lg-6" id="descripcion" class="datos"></div>-->
                    <!--                <button id="desc" onclick="mostrar('descripcion')" class="boton">Ver descripción</button>-->

                    <!-- MAPA DE LA RUTA -->
                    <div class="col-sm-12 col-lg-6 text-center">
                        <h2>Mapa de la ruta</h2>
                        <img id="mapa" src="imagenes/mapa.gif" alt="mapa"/>
                    </div>
                </div>
            </div>


            <!-- DATOS DE LA RUTA -->
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="text-center">Datos de la ruta</h2>

                   <!-- <span class="negrita">Tipo de ruta:</span> <?/*//= $model->tipo */?>
                    <?php
/*                    if($model->tipo=="Andando"){
                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Andando.svg'/></span>";
                    }else if($model->tipo=="Bicicleta"){
                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Bicicleta.svg'/></span>";
                    }else if($model->tipo=="Coche"){
                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Coche.svg'/></span>";
                    }else{
                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Moto.svg'/></span>";
                    }
                    */?>

                    <span class="negrita">Dificultad:</span> <?/*//= $model->dificultad */?>
                    --><?php
/*                    if($model->dificultad=='Principiante' || $model->dificultad=='Facil'){
                        echo "<span class='label label-success'>$model->dificultad</span>";
                    }else if($model->dificultad=='Intermedio'){
                        echo "<span class='label label-warning'>$model->dificultad</span>";
                    }else{
                        echo "<span class='label label-danger'>$model->dificultad</span>";
                    }
                    */?>

                    <table class="table">
                        <tr>
                            <th>Tipo de ruta</th>
                            <td>
                                <?php
                                    if($model->tipo=="Andando"){
                                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Andando.svg'/></span>";
                                    }else if($model->tipo=="Bicicleta"){
                                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Bicicleta.svg'/></span>";
                                    }else if($model->tipo=="Coche"){
                                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Coche.svg'/></span>";
                                    }else{
                                        echo "<span class='tipo'><img class='icono' src='imagenes/iconos/tipo-ruta/Moto.svg'/></span>";
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>


            <!-- FOTOGRAFÍAS -->
            <div class="row">
                <!-- SI LA RUTA TIENE FOTOS CREAR CON UN FOREACH UN DIV PARA CADA FOTO QUE TENGA ESA RUTA. -->
                <?php
                    if($fotos){
                        echo "<h2 class='text-center'>Fotografías</h2>";
                        foreach($fotos as $k => $foto){
                            echo "<div class='col-md-3 col-xs-6'>";
                                echo "<a href='#' class='thumbnail'>";
                            //die(var_dump($fotos));
                                    echo "<img class='fotosRutas' style='height: 180px; width: 100%; display: block;' src='imgRutas/". $foto->id_ruta . '/' . $foto->id .".jpg'>";  //Modificar la extensión del archivo
                                echo "</a>";
                            echo "</div>";

                        }
                    }
                ?>
            </div>

            <!-- PUNTUACIÓN -->
            <div class="col-lg-6">
                <a href="" id="positivo" name="positivo" data-id="<?= $model->id ?>" data-url="<?php echo Yii::$app->request->baseUrl. '?r=rutas/votar' ?>"><img class='icono' src="imagenes/iconos/votos/positivo.svg" alt="voto positivo"/></a>
                <a href="" id="negativo" name="negativo" data-id="<?= $model->id ?>" data-url="<?php echo Yii::$app->request->baseUrl. '?r=rutas/votar' ?>"><img class='icono' src="imagenes/iconos/votos/negativo.svg" alt="voto negativo" /></a>
<!--                <a href="" id="positivo" name="positivo" data-id="--><?//= $model->id ?><!--" data-url="--><?php //echo Yii::$app->request->baseUrl. '?r=rutas/votar' ?><!--">Positivo</a>-->
<!--                <a href="" id="negativo" name="negativo" data-id="--><?//= $model->id ?><!--" data-url="--><?php //echo Yii::$app->request->baseUrl. '?r=rutas/votar' ?><!--">Negativo</a>-->
                <?php
                if($model->puntuacion>0){
                    echo "<span class='verde puntuacion'>Puntuación: ". $model->puntuacion ."</span>";
                }else{
                    echo "<span class='rojo puntuacion'>Puntuación: ". $model->puntuacion ."</span>";
                }
                ?>

            </div>

            <!-- COMENTARIOS -->
            <div class="col-lg-12">
                <h2>Comentarios</h2>
                <div id="comentarios">
                    <?php
                     //AQUI VAN LOS COMENTARIOS DE LA RUTA
                    foreach($comentarios as $k => $comentario){
                        echo "<div class='comentario'>";
                            $usuario = $comentario->getUsuario()->all();
                            echo "<hr>";
                            echo "<span class='uComentario'>".$usuario[0]->nombre."</span>";
                            echo "<p class='fecha'>". Rutas::formatoFechaHora($comentario->fecha_hora) ."</p>";
                            echo "<p>$comentario->comentario</p>";
                        echo "</div>";
                    }
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    ?>
                </div>
                <div class="col-lg-6">
                    <textarea name="comentarios" id="comentario" cols="30" rows="10" class="form-control" maxlength="150" placeholder="Introduce tu comentario aquí"></textarea>
                </div>

                <div class="col-lg-12">
                    <button id="btn-cmt" class="btn btn-primary" data-rol="<?= Yii::$app->user->isGuest ?>" data-id="<?= $model->id ?>" data-user="<?= Yii::$app->user->id ?>" data-url="<?= Yii::$app->request->baseUrl. '?r=rutas/comentar'?>">Enviar comentario</button>
                </div>
            </div>
        </div>
    </div>
</div>