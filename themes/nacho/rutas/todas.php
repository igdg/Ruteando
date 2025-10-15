<?php
use app\themes\nacho\assets\AppAsset;
use yii\helpers\Url;

/* @var $rutas array */
$this->title = 'Rutas';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>
    <div class="row">
        <div class="text-center col-lg-12">
            <h2>Rutas</h2>
        </div>
    </div>
        <div class="cAccionesRutas row">
            <!-- SELECT ORDENAR RUTAS -->
            <label for="columna">Ordenar por:</label>
            <div class="col-lg-6 input-group inputTodasRutas">
                <!--            <span>Ordenar por: </span>-->
                <select name="columna" id="columna" class="form-control" data-url="<?= Yii::$app->request->baseUrl . '?r=rutas/ordenar' ?>">
                    <option value="" disabled selected="selected">Seleccionar uno</option>
                    <option value="dificultad">Dificultad</option>
                    <option value="tipo">Tipo</option>
                    <option value="fecha desc">Fecha</option>
                    <option value="puntuacion desc">Puntuación</option>
                </select>
            </div>

            <label for="buscador">Buscador</label>
            <div class="col-lg-6 input-group inputTodasRutas">
                <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-search"></i></span>
                <input id="buscador" type="text" class="form-control" data-url="<?= Url::to(['rutas/buscador']); ?>" aria-describedby="basic-addon1" placeholder="Buscar"/>
            </div>
        </div>

        <?php
            echo $this->render('divRutas', ['rutas' => $rutas, 'pagination' => $pagination]);
        ?>