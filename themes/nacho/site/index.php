<?php
use yii\helpers\Html;
use app\models\Rutas;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use app\themes\nacho\assets\AppAsset;

/* @var $this yii\web\View */

$this->title = 'Ruteando';
AppAsset::register($this);
?>
<!-- Intro Header -->
<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="brand-heading">Ruteando</h1>
                    <p class="intro-text">Tu web de rutas favorita.
                        <br>Todas nuestras rutas <a href="<? echo Url::to(['rutas/todas']) ?>">aquí.</a></p>
                    <a id="move" href="#id_rutas" class="btn btn-circle btnRutas">
                        <i class="fa fa-angle-double-down animated"></i>
                    </a>
            </div>
        </div>
    </div>
</header>

<section id="id_rutas" class="container content-section">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2 class="text-center">Últimas rutas</h2>
            <ul class="row iconoUl">
                <?php
                foreach ($rutas as $k => $ruta) {
                    ?>
                    <li class="col-sm-12 col-lg-6">
                        <div class="rutasPanel">
                            <a href="<?= Url::to(['rutas/view', 'id' => $ruta->id]); ?>">
                                <h3><?= $ruta->nombre ?></h3>
                            </a>
                            <p class="pDesc""><?= StringHelper::truncate($ruta->descripcion, 100) ?></p>
                            <div class="row text-center">
                                <?php

                                if ($ruta->tipo == "Andando") {
                                    echo Html::img('imagenes/iconos/tipo-ruta/Andando.svg', ['class' => 'imgIconos posicionIRutas']);
                                } else if ($ruta->tipo == "Bicicleta") {
                                    echo Html::img('imagenes/iconos/tipo-ruta/Bicicleta.svg', ['class' => 'imgIconos posicionIRutas']);
                                } else if ($ruta->tipo == "Coche") {
                                    echo Html::img('imagenes/iconos/tipo-ruta/Coche.svg', ['class' => 'imgIconos posicionIRutas']);
                                } else {
                                    echo Html::img('imagenes/iconos/tipo-ruta/Moto.svg', ['class' => 'imgIconos posicionIRutas']);
                                }

                                if ($ruta->dificultad == 'Principiante' || $ruta->dificultad == 'Facil') {
                                    echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-success ']);
                                } else if ($ruta->dificultad == 'Intermedio') {
                                    echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-warning ']);
                                } else {
                                    echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-danger ']);
                                }

                                ?>
                                <span class="fecha posicionFRutas"><?= Rutas::formatoFecha($ruta->fecha); ?></span>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</section>

<section id="create" class="content-section text-center">
    <div class="download-section">
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Ruteando</h2>
                <?php
                if (Yii::$app->user->isGuest) {
                    ?>
                    <p>¡Registrate ahora y crea tus propias rutas!</p>
                    <a href="<?php echo Url::to(['usuarios/create']) ?>" class="btn btn-default btn-lg">Registrarme</a>
                    <?php
                } else {
                    ?>
                    <p>¡Crea una nueva ruta!</p>
                    <a href="<?php echo Url::to(['rutas/create']) ?>" class="btn btn-default btn-lg">Crear ruta</a>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</section>

<section id="contact" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Contactar con ruteando</h2>
            <p>Puedes contactar con nosotros a través de nuestro correo electrónico, redes sociales o haciendo click <a
                        href="<?php echo Url::to(['site/contact']); ?>">aquí.</a></p>
            <p><a href="mailto:contacto@ruteando.com">contacto@ruteando.com</a>
            </p>
            <ul class="list-inline banner-social-buttons">
                <li>
                    <a href="https://twitter.com/" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i>
                        <span class="network-name">Twitter</span></a>
                </li>
                <li>
                    <a href="https://facebook.com/" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i>
                        <span class="network-name">Facebook</span></a>
                </li>
                <li>
                    <a href="https://instagram.com/" class="btn btn-default btn-lg"><i
                                class="fa fa-instagram fa-fw"></i> <span class="network-name">Instagram</span></a>
                </li>
            </ul>
        </div>
    </div>
</section>