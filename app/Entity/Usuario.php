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

        $this->setValue('_nombre', $user->nombre);
        $this->setValue('_usuario', $user->usuario);
        $this->setValue('_password', $user->password);
        $this->setValue('_rol', $user->rol);
        $this->setValue('_pais', $user->pais);
        $this->setValue('_region', $user->region);
        $this->setValue('_departamento', $user->departamento);
        $this->setValue('_distrito', $user->distrito);
        $this->setValue('_calle', $user->calle);
        $this->setValue('_estado', $user->estado);
        $this->setValue('_correo', $user->correo);
    }


    static function redirectRol($rol) {
        
        switch ($rol) {
            case self::ROL_ADMINISTRADOR:
                return 'productos';
                break;
            case self::ROL_USUARIOS:
                return 'productos';
                break;
            default:
                return 'login.index';
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
