<?php
use yii\helpers\Html;

$this->title = 'Panel de administración';
$this->params['breadcrumbs'][] = $this->title;
\app\themes\nacho\assets\AppAsset::register($this);
?>
<div class="adminPanel">

    <h1><?= Html::encode($this->title) ?></h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Rutas inactivas</a></li>
        <li><a data-toggle="tab" href="#menu1">Rutas activas</a></li>
        <li><a data-toggle="tab" href="#menu2">Usuarios inactivos</a></li>
        <li><a data-toggle="tab" href="#menu3">Usuarios activos</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active table-responsive">
            <table class="table table-bordered fondoTablaAdmin">
                <tr class="cabeceraTablaAdmin">
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Ver</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Activar</th>
                </tr>
                <?php
                foreach ($rutas as $k => $ruta) {
                    ?>
                    <tr>
                        <td><?php echo $ruta->nombre ?></td>
                        <td class="text-center"><?php if($ruta->status==0){echo 'Inactiva';} ?></td>
                        <td class="text-center"><?php echo $ruta->fecha ?></td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['rutas/view', 'id' => $ruta->id]) ?>"><span
                                    class="glyphicon glyphicon-eye-open"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['rutas/update', 'id' => $ruta->id]) ?>"><span
                                    class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['rutas/activar', 'id' => $ruta->id]) ?>"><span
                                    class="glyphicon glyphicon-ok"></span></a>
                        </td>
                    </tr>
                <?php

                }
                ?>
            </table>
        </div>
        <div id="menu1" class="tab-pane fade table-responsive">
            <table class="table table-bordered fondoTablaAdmin">
                <tr class="cabeceraTablaAdmin">
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Ver</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Desactivar</th>
                </tr>
                <?php
                foreach ($rutasActivas as $k => $rutaActiva) {
                    ?>
                    <tr>
                        <td><?php echo $rutaActiva->nombre ?></td>
                        <td class="text-center"><?php if($rutaActiva->status==1){echo 'Activa';} ?></td>
                        <td class="text-center"><?php echo $rutaActiva->fecha ?></td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['rutas/view', 'id' => $rutaActiva->id]) ?>"><span
                                    class="glyphicon glyphicon-eye-open"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['rutas/update', 'id' => $rutaActiva->id]) ?>"><span
                                    class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['rutas/desactivar', 'id' => $rutaActiva->id]) ?>"><span
                                    class="glyphicon glyphicon-remove" style="color:red"></span></a>
                        </td>
                    </tr>
                <?php

                }
                ?>
            </table>
        </div>
        <div id="menu2" class="tab-pane fade table-responsive">
            <table class="table table-bordered fondoTablaAdmin">
                <tr class="cabeceraTablaAdmin">
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Ver</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Activar</th>
                </tr>
                <?php
                foreach ($usuarios as $k => $usuario) {
                    ?>
                    <tr>
                        <td><?php echo $usuario->id ?></td>
                        <td><?php echo $usuario->nombre ?></td>
                        <td class="text-center"><?php echo $usuario->email ?></td>
                        <td class="text-center"><?php if($usuario->status==0){echo 'Inctivo';} ?></td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['usuarios/view', 'id' => $usuario->id]) ?>"><span
                                    class="glyphicon glyphicon-eye-open"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['usuarios/update', 'id' => $usuario->id]) ?>"><span
                                    class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['usuarios/activar', 'id' => $usuario->id]) ?>"><span
                                    class="glyphicon glyphicon-ok"></span></a>
                        </td>
                    </tr>
                <?php

                }
                ?>
            </table>
        </div>
        <div id="menu3" class="tab-pane fade table-responsive">
            <table class="table table-bordered fondoTablaAdmin">
                <tr class="cabeceraTablaAdmin">
                    <th class="text-center">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Ver</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Desactivar</th>
                </tr>
                <?php
                foreach ($usuariosActivos as $k => $usuarioActivo) {
                    ?>
                    <tr>
                        <td><?php echo $usuarioActivo->id ?></td>
                        <td><?php echo $usuarioActivo->nombre ?></td>
                        <td class="text-center"><?php echo $usuarioActivo->email ?></td>
                        <td class="text-center"><?php if($usuarioActivo->status==10){echo 'Activo';} ?></td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['usuarios/view', 'id' => $usuarioActivo->id]) ?>"><span
                                    class="glyphicon glyphicon-eye-open"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['usuarios/update', 'id' => $usuarioActivo->id]) ?>"><span
                                    class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= \yii\helpers\Url::to(['usuarios/desactivar', 'id' => $usuarioActivo->id]) ?>"><span
                                    class="glyphicon glyphicon-remove" style="color:red"></span></a>
                        </td>
                    </tr>
                <?php

                }
                ?>
            </table>
        </div>
    </div>



</div>