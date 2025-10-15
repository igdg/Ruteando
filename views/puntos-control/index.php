<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puntos Controls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puntos-control-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Puntos Control', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'latitud',
            'longitud',
            'id_ruta',
            'orden',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
