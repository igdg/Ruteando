<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PuntosControl */

$this->title = 'Create Puntos Control';
$this->params['breadcrumbs'][] = ['label' => 'Puntos Controls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntos-control-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
