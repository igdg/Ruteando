<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FotosRutas */

$this->title = 'Create Fotos Rutas';
$this->params['breadcrumbs'][] = ['label' => 'Fotos Rutas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotos-rutas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
