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
    protected $_token;
    protected $_flgactivo;
    

    public function setFromAuth($user) {

        $this->setValue('_nombre', $user->nombre);
        $this->setValue('_usuario', $user->usuario);
        $this->setValue('_password', $user->password);
        $this->setValue('_rol', $user->rol);
        $this->setValue('_token', $user->token);
        $this->setValue('_flgactivo', $user->flg_activo);
    }


    static function redirectRol($rol) {
        
        switch ($rol) {
            case self::ROL_ADMINISTRADOR:
                return 'usuario.index';
                break;
            case self::ROL_USUARIOS:
                return 'usuario.index';
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
