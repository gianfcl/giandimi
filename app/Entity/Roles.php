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

    function setValues($data) {

        $this->setValue('_rol', $data->ROL);
        $this->setValue('_nombre', $data->NOMBRE);
        $this->setValue('_flgactivo', $data->FLG_ACTIVO);
    }

    function getRoles($activos=false,$rol=null)
    {
        $model = new mRoles();
        if (!empty($rol)) {
            return $model->getRoles($activos,$rol)->first();
        }else{
            return $model->getRoles($activos,$rol);
        }
    }

    function Addrol($data)
    {
        $datos = [
            'NOMBRE'=>strtoupper($data['NOMBRE']),
            'FLG_ACTIVO'=>$data['FLG_ACTIVO']
        ];
        $model = new mRoles();
        return $model->AddRol($datos);
    }

    function ChangeEstadoRol($data)
    {
        $actualizar=[
            'FLG_ACTIVO'=>$data['activo']==1?0:1
        ];
        $model = new mRoles();
        return $model->EditRol($data['id'],$actualizar);
    }
}
