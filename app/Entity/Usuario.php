<?php

namespace App\Entity;

use App\Model\Usuario as mUsuario;
use App\Entity\Roles as Roles;
use \Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB;

class Usuario extends \App\Entity\Base\Entity {

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
            case Roles::ROL_ADMINISTRADOR:
                return 'usuario.index';
                break;
            case Roles::ROL_JEFE:
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

    function getUsuarios($usuario=null,$password=null){
        $model = new mUsuario();
        if (!empty($usuario) && !empty($password)) {
            return $model->getUsuarios($usuario,$password)->first();
        }else{
            return $model->getUsuarios($usuario,$password);
        }
    }

    function Addusuario($data)
    {
        $data['flg_activo']=1;
        // dd($data);
        $model = new mUsuario();
        if ($model->Addusuario($data)) {
            return mUsuario::updatePassword($data['usuario'], $data['password']);
        }
        return false;
    }

    function Editusuario($data)
    {
        $actualizar=[
            'usuario'=>$data['usuario'],
            'nombre'=>$data['nombre'],
            'rol'=>$data['rol']
        ];
        // dd($data['id'],$actualizar);
        $model = new mUsuario();
        return $model->Editusuario($data['id'],$actualizar);
    }

    function ChangeEstadousuario($data)
    {
        $actualizar=[
            'flg_activo'=>$data['activo']==1?0:1
        ];
        $model = new mUsuario();
        return $model->Editusuario($data['id'],$actualizar);
    }
}
