<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fotos Rutas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fotos-rutas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fotos Rutas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'imagen',
            'id_ruta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
