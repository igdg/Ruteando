<?php
use yii\helpers\Html;
use app\models\Rutas;

/* @var $this yii\web\View */

$this->title = 'Ruteando';
?>
<style>
    /* Carousel base class */
    .carousel {
        height: 500px;
        margin-bottom: 60px;
    }
    /* Since positioning the image, we need to help out the caption */
    .carousel-caption {
        z-index: 10;
    }

    /* Declare heights because of positioning of img element */
    .carousel .item {
        height: 500px;
        background-color: #777;
    }
    .carousel-inner > .item > img {
        position: absolute;
        top: 0;
        left: 0;
        min-width: 100%;
        height: 500px;
    }

    span.label{
        font-size: 1em;
        margin-left: 10%;
        margin-right: 10%;
    }

    img{
        height: 50px;
    }

    span.fecha{
        font-weight: bold;
    }


</style>
<div class="site-index">
    <div class="body-content">
        <!-- Carousel================================================== -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
<!--                    <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">-->
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Example headline.</h1>
                            <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
<!--                    <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">-->
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="item">
<!--                    <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">-->
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>One more for good measure.</h1>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- /.carousel -->


        <div class="row">
            <!--MEJORES RUTAS-->
            <div class="col-lg-4">
                <div class="panel panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="text-center">Mejores rutas</h2>
                    </div>
                    <div class="panel-body">
                        <!-- PONER LAS RUTAS CON UN LIST GROUP-->
                        <div class="list-group">
                            <?php
                                foreach($mejoresRutas as $k => $mejor){
                                    ?>
                                        <a href="<?= Yii::$app->request->baseUrl. '?r=rutas/view&id='. $mejor->id ?>" class="list-group-item">
                                            <h3 class="list-group-item-heading"><?= $mejor->nombre ?></h3>
                                            <p class="list-group-item-text"><?= \yii\helpers\BaseStringHelper::truncate($mejor->descripcion, 100) ?></p>
                                            <p class="text-center">
                                                <?php
                                                    if($mejor->tipo=="Andando"){
                                                        echo Html::img('imagenes/iconos/tipo-ruta/Andando.svg');
                                                    }else if($mejor->tipo=="Bicicleta"){
                                                        echo Html::img('imagenes/iconos/tipo-ruta/Bicicleta.svg');
                                                    }else if($mejor->tipo=="Coche"){
                                                        echo Html::img('imagenes/iconos/tipo-ruta/Coche.svg');
                                                    }else{
                                                        echo Html::img('imagenes/iconos/tipo-ruta/Moto.svg');
                                                    }

                                                    if($mejor->dificultad=='Principiante' || $mejor->dificultad=='Facil'){
                                                        echo Html::tag('span', $mejor->dificultad, ['class' => 'label label-success']);
                                                    }else if($mejor->dificultad=='Intermedio'){
                                                        echo Html::tag('span', $mejor->dificultad, ['class' => 'label label-warning']);
                                                    }else{
                                                        echo Html::tag('span', $mejor->dificultad, ['class' => 'label label-danger']);
                                                    }
                                                ?>
                                                <span class="fecha"><?= Rutas::formatoFecha($mejor->fecha); ?></span>
                                            </p>
                                        </a>
                                    <?php
                                }
                            ?>
                        </div>
<!--                        --><?php
//                        foreach ($mejoresRutas as $k => $mejor) {
//                            $titulo = Html::a(Html::tag("h3", $mejor->nombre), ['rutas/view', 'id' => $mejor->id]); //'?r=rutas/view&id='.$mejor->id
//                            //$tipo = Html::tag("p", $mejor->tipo);
//
//                            //Imagen dependiendo del tipo
//                            if($mejor->tipo=="Andando"){
//                                $tipo = Html::tag('p', Html::img('imagenes/iconos/tipo-ruta/Andando.svg'), ['class'=>'tipo']);
//                            }else if($mejor->tipo=="Bicicleta"){
//                                $tipo = Html::tag('p', Html::img('imagenes/iconos/tipo-ruta/Bicicleta.svg'), ['class'=>'tipo']);
//                            }else if($mejor->tipo=="Coche"){
//                                $tipo = Html::tag('p', Html::img('imagenes/iconos/tipo-ruta/Coche.svg'), ['class'=>'tipo']);
//                            }else{
//                                $tipo = Html::tag('p', Html::img('imagenes/iconos/tipo-ruta/Moto.svg'), ['class'=>'tipo']);
//                            }
//
//                            //Creación de un label distinto para cada dificultad
//                            if($mejor->dificultad=='Principiante' || $mejor->dificultad=='Facil'){
//                                $dificultad = Html::tag('span', $mejor->dificultad, ['class' => 'label label-success']);
//                            }else if($mejor->dificultad=='Intermedio'){
//                                $dificultad = Html::tag('span', $mejor->dificultad, ['class' => 'label label-warning']);
//                            }else{
//                                $dificultad = Html::tag('span', $mejor->dificultad, ['class' => 'label label-danger']);
//                            }
//
//                            echo Html::tag("div", $titulo . $tipo . $dificultad, ['class' => 'col-lg-12 text-center panel-body']);
//                        }
//                        ?>
                    </div>
                </div>
            </div>
            <!--ÚLTIMAS RUTAS-->
            <div class="col-lg-8 panel">
                <div class="panel panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="text-center">Últimas rutas</h2>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php
                            foreach($rutas as $k => $ruta){
                                ?>
                                <a href="<?= Yii::$app->request->baseUrl. '?r=rutas/view&id='. $ruta->id ?>" class="list-group-item">
                                    <h3 class="list-group-item-heading"><?= $ruta->nombre ?></h3>
                                    <p class="list-group-item-text"><?= \yii\helpers\BaseStringHelper::truncate($ruta->descripcion, 100) ?></p>
                                    <p class="text-center">
                                        <?php
                                        if($ruta->tipo=="Andando"){
                                            echo Html::img('imagenes/iconos/tipo-ruta/Andando.svg');
                                        }else if($ruta->tipo=="Bicicleta"){
                                            echo Html::img('imagenes/iconos/tipo-ruta/Bicicleta.svg');
                                        }else if($ruta->tipo=="Coche"){
                                            echo Html::img('imagenes/iconos/tipo-ruta/Coche.svg');
                                        }else{
                                            echo Html::img('imagenes/iconos/tipo-ruta/Moto.svg');
                                        }

                                        if($ruta->dificultad=='Principiante' || $ruta->dificultad=='Facil'){
                                            echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-success']);
                                        }else if($ruta->dificultad=='Intermedio'){
                                            echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-warning']);
                                        }else{
                                            echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-danger']);
                                        }
                                        ?>
                                        <span class="fecha"><?= Rutas::formatoFecha($ruta->fecha); ?></span>
                                    </p>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

