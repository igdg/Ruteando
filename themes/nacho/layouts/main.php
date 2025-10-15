<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\themes\nacho\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--Inicio menu-->
<?php
NavBar::begin([
    'brandLabel' => 'Ruteando',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-custom navbar-fixed-top',
        'role' => 'navigation',
    ],
    'screenReaderToggleText' => 'Menú'
]);
?>
<div class="navbar-collapse navbar-right navbar-main-collapse">
    <?php
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav navbar-right'],    //'navbar-nav navbar-right
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            //['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contacto', 'url' => ['/site/contact']],
            ['label' => 'Rutas', 'url' => ['rutas/todas']],
            ['label' => 'Registro', 'url' => ['/usuarios/create'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Crear ruta', 'url' => ['/rutas/create'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Perfil', 'url' => ['/usuarios/view', 'id'=>Yii::$app->user->id], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Administración', 'url' => ['/site/admin'], 'visible' => Yii::$app->user->can('actualizarRuta')],

            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
                //['label' => 'Registro', 'url' => ['/usuarios/create']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    ?>
<?php
NavBar::end();
?>
<!-- Fin menu-->


<?php
    if(Yii::$app->controller->id !="site"){
        ?>
        <div class="container margenContainer">
            <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
            <?= $content ?>
        </div>
        <?php
    }else{
        if(Yii::$app->controller->action->id != "index"){
            ?>
            <div class="container margenContainer">
                <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
                <?= $content ?>
            </div>
            <?php
        }else{
            echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]);
            echo $content;
        }
    }
?>

<a href="#" class="scrollup">Scroll</a>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Ruteando <?= date('Y') ?></p>

        <!--<p class="pull-right"><?/*= Yii::powered() */?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
