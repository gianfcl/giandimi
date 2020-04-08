<?php

namespace App\Entity;

use App\Model\Roles as mRoles;
use DB;

class Roles extends \App\Entity\Base\Entity {

    const ROL_ADMINISTRADOR = 1;
    const ROL_JEFE = 2;
    const ROL_TRABAJADOR = 3;

    protected $_rol;
    protected $_nombre;
    protected $_flgactivo;

    function setFormatValue() {

        $this->setValue('_rol', $user->ROL);
        $this->setValue('_nombre', $user->NOMBRE);
        $this->setValue('_flgactivo', $user->FLG_ACTIVO);
    }

    function getRoles($rol=null)
    {
        $model = new mRoles();
        if (!empty($rol)) {
            return $model->getRoles($rol)->first();
        }else{
            return $model->getRoles($rol);
        }
    }
}
