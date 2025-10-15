<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rutas */

$this->title = 'Update Rutas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rutas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
    ]) ?>

</div>
