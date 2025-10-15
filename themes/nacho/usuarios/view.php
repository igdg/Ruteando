<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
\app\themes\nacho\assets\AppAsset::register($this);
$this->title = $model->nombre;

?>
<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <!-- <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> -->


                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <span class="hidden-xs"><?php echo $model->nombre ?></span>
                    </div>
                    <div class="profile-usertitle-job">
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="" id="btndatos" data-toggle="tab">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Mis datos<span> </a>
                        </li>
                        <li>
                            <a href="" id="btnrutas" data-toggle="tab">
                                <i class="glyphicon glyphicon-ok"></i>
                                <span>Mis rutas <span></a>
                        </li>

                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9 order-content">
            <div class="form_main col-md-4 col-sm-5 col-xs-7 tabcontent" id="datos">
                <h4 class="heading"><strong>Información </strong> general <span></span></h4>
                <div class="botonesAcciones">
                    <?php echo Html::a('Actualizar datos', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?php
                    if (Yii::$app->user->can('actualizarRuta')) {
                        if ($model->status == 10) {
                            echo Html::a('Desactivar', ['desactivar', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => '¿Estás seguro de desactivar a este usuario?',
                                ]
                            ]);
                        } else {
                            echo Html::a('Activar', ['activar', 'id' => $model->id], [
                                'class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => '¿Estás seguro de activar a este usuario?',
                                ]
                            ]);
                        }
                    }
                    ?>
                </div>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'email',
                        'nombre',
                    ],
                    'options' => [
                        'class' => 'table table-bordered detail-view fondoTablaAdmin',
                    ],
                    'template' => '<tr><th class="cabeceraTablaAdmin text-center" {captionOptions}>{label}</th><td class="text-center" {contentOptions}>{value}</td></tr>',
                ]) ?>
            </div>

            <div class="form_main col-md-4 col-sm-5 col-xs-7 tabcontent" id="rutas" hidden="hidden">
                <h4 class="heading"><strong>Mis </strong> rutas <span></span></h4>
                <div class="table-responsive">
                    <table class="table table-bordered fondoTablaAdmin">
                        <thead>
                        <th class="cabeceraTablaAdmin text-center">Nombre ruta</th>
                        <th class="cabeceraTablaAdmin text-center">Fecha</th>
                        <th class="cabeceraTablaAdmin text-center">Visitar</th>
                        <th class="cabeceraTablaAdmin text-center">Modificar</th>
                        </thead>
                        <?php
                        foreach ($rutas as $k => $ruta) {
                            ?>
                            <tr>
                                <td><?php echo $ruta->nombre ?></td>
                                <td><?php echo \app\models\Rutas::formatoFecha($ruta->fecha)?></td>
                                <td class="text-center">
                                    <a href="<?= \yii\helpers\Url::to(['rutas/view', 'id' => $ruta->id]) ?>"><span
                                                class="glyphicon glyphicon-eye-open"></span></a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= \yii\helpers\Url::to(['rutas/update', 'id' => $ruta->id]) ?>"><span
                                                class="glyphicon glyphicon-pencil"></span></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>

        </div>


    </div>
</div>

