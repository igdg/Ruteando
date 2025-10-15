<?php
/**
 * Created by PhpStorm.
 * User: xenon-pb
 * Date: 27/03/2017
 * Time: 11:42
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Rutas;
?>
<!-- RUTAS -->
<div class="col-lg-12 list-group">
    <?php

    foreach($rutas as $k => $ruta){
        ?>
        <div class="col-sm-12 col-lg-6">
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
        </div>
    <?php
    }

    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>
</div>