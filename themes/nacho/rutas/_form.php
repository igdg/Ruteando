<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rutas */
/* @var $form yii\widgets\ActiveForm */
?>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG3FzyST96Ql_7YzQ_K4gjvf60mX84sMQ&libraries=geometry" async defer></script>-->
<div class="rutas-form">

    <?php $form = ActiveForm::begin(["method" => "post", "options" => ["enctype" => "multipart/form-data"],]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'Andando' => 'Andando', 'Bicicleta' => 'Bicicleta', 'Coche' => 'Coche', 'Moto' => 'Moto', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'dificultad')->dropDownList([ 'Principiante' => 'Principiante', 'Facil' => 'Facil', 'Intermedio' => 'Intermedio', 'Dificil' => 'Dificil', ], ['prompt' => '']) ?>

    <?= $form->field($model1, "imageFiles[]")->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <span>Puedes seleccionar hasta 4 imágenes</span>

    <div style="margin-bottom: 10px;">
        <label for="mapa">Mapa</label>
        <div id="mapa"></div>
    </div>

    <input type="hidden" name="puntos_control" id="puntos_control"/>


    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-default']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
