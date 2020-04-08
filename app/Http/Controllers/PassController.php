<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entity\Usuario as Usuario;
use Validator;

class PassController extends Controller {

    public function gen() {     
        //Usuario::updateMasive();   
        return view('pass-gen')
                ->with('passw', $this->generateRandomString(6));
    }



    public function save(Request $request) {

        $registro = strtoupper($request->get('registro', null));
        $password = $request->get('passw', null);
        //actualizar password
        if (\App\Model\Usuario::updatePassword($registro, $password)){
            flash('Pass actualizado para el registro ' . $registro . ': ' . $password)->success();
        }else{
            flash('Registro no encontrado/Error al actualizar')->error();
        }
        return redirect()->route('pass.gen');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        } 
        return $randomString;
    }

    function updatePassForm(){
        //Aqui se mostrará la vista del formulario para que el usuario pueda cambiar su contraseña
        return view('pass-update');
        
    }
}
