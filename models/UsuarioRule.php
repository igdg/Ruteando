<?php
/**
 * Created by PhpStorm.
 * User: xenon-pb
 * Date: 18/04/2017
 * Time: 9:18
 */

namespace app\models;



use yii\rbac\Rule;

class UsuarioRule extends Rule
{
    public $name = 'isUsuario';

    /**
     * @param string|int $user el ID de usuario.
     * @param Item $item el rol o permiso asociado a la regla
     * @param array $params parámetros pasados a ManagerInterface::checkAccess().
     * @return bool un valor indicando si la regla permite al rol o permiso con el que está asociado.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->id == $user : false;
    }

}