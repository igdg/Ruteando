<?php
use app\themes\nacho\assets\AppAsset;
use yii\widgets\ActiveForm;

/* @var $rutas array */
$this->title = 'Rutas';
$this->params['breadcrumbs'][] = $this->title;
AppAsset::register($this);
?>
<style>
    span.label {
        font-size: 1em;
        margin-left: 10%;
        margin-right: 10%;
    }

    img {
        height: 50px;
    }

    span {
        font-weight: bold;
    }

    .anchura {
        width: 30%;
    }
</style>

<div class="text-center col-lg-12">
    <h2>Rutas</h2>
</div>
<!-- SELECT ORDENAR RUTAS -->
<div class="col-lg-6">
    <span>Ordenar por: </span>

    <select name="columna" id="columna" class="form-control anchura"
            data-url="<?= Yii::$app->request->baseUrl . '?r=rutas/ordenar' ?>">
        <option value=""></option>
        <option value="dificultad">Dificultad</option>
        <option value="tipo">Tipo</option>
        <option value="fecha desc">Fecha</option>
    </select>
</div>


<!-- BUSCADOR RUTAS -->
<div class="col-lg-6">
    <span>Buscador:</span>
    <input id="buscador" type="text" class="form-control anchura"
           data-url="<?= Yii::$app->request->baseUrl . '?r=rutas/buscador' ?>" placeholder="Buscar"/>
</div>

<?php
echo $this->render('divRutas', ['rutas' => $rutas, 'pagination' => $pagination]);
?>
