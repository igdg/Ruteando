<?php
/**
 * Created by PhpStorm.
 * User: xenon-pb
 * Date: 17/04/2017
 * Time: 15:18
 */

namespace app\controllers;
use app\models\UsuarioRule;
use Yii;
use yii\web\Controller;



class RbacController extends Controller{
    public function actionInit()
    {
       /* $auth = Yii::$app->authManager;

        $usuario = $auth->createRole('usuario');
        $auth->add($usuario);


        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $usuario);*/

        /*$auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');
        $auth->assign($admin, 15);*/

//        $auth = Yii::$app->authManager;
//
//        // agrega el permiso "actualizarRuta"
//        /*$actualizarRuta = $auth->createPermission('actualizarRuta');
//        $actualizarRuta->description = 'Actualizar ruta';
//        $auth->add($actualizarRuta);*/
//        $actualizarRuta = $auth->getPermission('actualizarRuta');
//
//        $usuario = $auth->getRole('usuario');
//
//    // agrega la regla
//        $rule = new UsuarioRule();
//        $auth->add($rule);
//
//    // agrega el permiso "updateOwnPost" y le asocia la regla.
//        $updateOwnPost = $auth->createPermission('actualizarPropiaRuta');
//        $updateOwnPost->description = 'Actualizar su propia ruta';
//        $updateOwnPost->ruleName = $rule->name;
//        $auth->add($updateOwnPost);
//
//    // "updateOwnPost" será utilizado desde "updatePost"
//        $auth->addChild($updateOwnPost, $actualizarRuta);
//
//    // permite a "author" editar sus propios posts
//        $auth->addChild($usuario, $updateOwnPost);

//        $auth = Yii::$app->authManager;
//        $admin = $auth->getRole('admin');
//        $actualizarRuta = $auth->getPermission('actualizarRuta');
//        $auth->assign($usuario, 14);

//        $auth->addChild($admin, $actualizarRuta);

    }
}
