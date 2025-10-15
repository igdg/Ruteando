<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Rutas;
use yii\helpers\StringHelper;

?>

<style>
    ul {
        list-style: none;
    }

</style>

<!-- RUTAS -->
<div id="listadoRutas">
    <ul class="row">
        <?php foreach ($rutas as $k => $ruta) { ?>
            <li class="col-sm-12 col-lg-6">
                <div class="rutasPanel">
                    <?php
                    $url = \yii\helpers\Url::base() . "/imagenes/noimage.png";
                    $fotos = $ruta->fotosRutas;
                    if ($fotos) {
                        $url = \yii\helpers\Url::base() . "/imgRutas/" . $ruta->id . "/" . $fotos[0]->id . ".jpg";
                    }

                    ?>
                    <a href="<?= Yii::$app->request->baseUrl . '?r=rutas/view&id=' . $ruta->id ?>">
                        <div class="fotoPanelRuta" style="background-image:url('<?php echo $url ?>') "></div>
                        <h3><?= $ruta->nombre ?></h3>
                    </a>

                    <p>
                        <?= StringHelper::truncate($ruta->descripcion, 90) ?>
                    </p>

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
                            echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-success']);
                        } else if ($ruta->dificultad == 'Intermedio') {
                            echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-warning']);
                        } else {
                            echo Html::tag('span', $ruta->dificultad, ['class' => 'label label-danger']);
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
    <?php
    echo LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>
</div>

