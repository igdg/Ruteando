<?php

use yii\helpers\Html;
use app\themes\nacho\assets\AppAsset;


/* @var $this yii\web\View */
/* @var $model app\models\Rutas */

AppAsset::register($this);
$this->registerJsFile(Yii::getAlias('@web') . '/js/mapa.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->title = 'Crear Ruta';
$this->params['breadcrumbs'][] = ['label' => 'Rutas', 'url' => ['todas']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rutas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
    ]) ?>

</div>
