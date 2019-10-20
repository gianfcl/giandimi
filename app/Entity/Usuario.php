<?php

namespace App\Entity;

use App\Model\Usuario as mUsuario;
use \Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Entity\Canal as Canal;
use DB;

class Usuario extends \App\Entity\Base\Entity {

    const ROL_ADMINISTRADOR = 1;
    const ROL_USUARIOS = 2;
    
    const ITEMS_PER_PAGE = 15;

    protected $_nombre;
    protected $_usuario;
    protected $_password;
    protected $_rol;
    protected $_pais;
    protected $_region;
    protected $_departamento;
    protected $_distrito;
    protected $_calle;
    protected $_estado;
    protected $_correo;

    public function setFromAuth($user) {

        $this->setValue('_nombre', $user->NOMBRE);
        $this->setValue('_usuario', $user->USUARIO);
        $this->setValue('_password', $user->PASSWORD);
        $this->setValue('_rol', $user->ROL);
        $this->setValue('_pais', $user->PAIS);
        $this->setValue('_region', $user->REGION);
        $this->setValue('_departamento', $user->DEPARTAMENTO);
        $this->setValue('_distrito', $user->DISTRITO);
        $this->setValue('_calle', $user->CALLE);
        $this->setValue('_estado', $user->ESTADO);
        $this->setValue('_correo', $user->CORREO);
    }


    static function redirectRol($rol) {
        
        switch ($rol) {
            case self::ROL_ADMINISTRADOR:
                return 'productos';
            case self::ROL_USUARIOS:
                return 'productos';
            default:
                return 'welcome';
        }
    }

    public function changePassword($registro,$apassword,$npassword){

        $model = new mUsuario();
        if (!($model->verifyPassword($registro,$apassword))){
            $this->setMessage('La contraseña ingresada no coincide con la original');
            return false;
        }
        else{
            $model->updateNewPassword($registro,$npassword);
            $this->setMessage('La contraseña fue cambiada exitosamente');
            return true;
        }

    }
    static function updateMasive(){
        $model = new mUsuario();
        $model->updateMasive();
    }

}
