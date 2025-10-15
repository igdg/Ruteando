<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FotosRutas */

$this->title = 'Update Fotos Rutas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fotos Rutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fotos-rutas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
