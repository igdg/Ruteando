<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rutas */

$this->title = 'Modificar ruta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rutas', 'url' => ['todas']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="rutas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(["method" => "post",]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'Andando' => 'Andando', 'Bicicleta' => 'Bicicleta', 'Coche' => 'Coche', 'Moto' => 'Moto', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'dificultad')->dropDownList([ 'Principiante' => 'Principiante', 'Facil' => 'Facil', 'Intermedio' => 'Intermedio', 'Dificil' => 'Dificil', ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
