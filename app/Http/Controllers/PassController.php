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

    public function login() {
        return view('pass-login');
    }

    //ALWAYS
    public function attempt(Request $request) {
        
        $registro = $request->get('registro', null);
        $password = $request->get('passw', null);

        $user = Usuario::getEjecutivoByRegistro($registro);
        if ($password == 'VPC201801*') {
            Auth::loginUsingId($user->ID);
        //dd($password);
            return redirect()->route(Usuario::redirectRol(Auth::user()->ROL))->with('popUpLogueo', 1);  
        }
        flash('Usuario o Contraseña errado')->error();
        return redirect()->route('pass.login');
        
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
    
    function updatePassInDatabase(Request $request){
        /*
            Mediante esta función lograremos actualizar en la base de datos
            la nueva contraseña que el usuario haya elegido
        */
            
            $passA=$request->input('passwA');
            $passN=$request->input('passwN');
            $passR=$request->input('passwR');

            //Usuario actual contiene una cadena. Ej: B34300
            $usuarioActual = $this->user->getValue('_registro'); 
            
            $usuario=new Usuario();
            
            /*
                Falta coreegir para el tema de la validación de manera sencilla
            $validator = Validator::make($request->all(), [
                'passwA' => 'required|max:20|min:6',
                'passwN' => 'required|max:20|min:6',
                'passwR' => 'required|max:20|min:6',
            ]);

            if ($validator->fails()) {
                flash(array_flatten($validator->errors()->getMessages()))->error();
                return back()->withInput($request->input());
            }
            else{

                if($usuario->changePassword($usuarioActual,$passA,$passN)){
                    flash($usuario->getMessage())->success();
                    return back();                    
                }
                else{
                    flash($usuario->getMessage())->error();
                    return back();
                }
            }
            */
            if(!($passN==$passR)) {
                 $usuario->setMessage('La contraseña de confirmación no coincide con la nueva ingresada');
                 flash($usuario->getMessage())->error();
                 return back();
            }
            else if(strlen($passN)<6 and strlen($passN)>20){
                 $usuario->setMessage('La contraseña debe ser mayor a 6 caracteres y menor a 20');
                 flash($usuario->getMessage())->error();
                 return back();
            }
            else{                
                if($passA==$passN){
                    $usuario->setMessage('La nueva contraseña debe de ser diferente de la anterior');
                    flash($usuario->getMessage())->error();
                    return back();
                }

                if($usuario->changePassword($usuarioActual,$passA,$passN)){
                    flash($usuario->getMessage())->success();
                    return back();
                    //return redirect()->route('pass.update');
                }
                else{
                    flash($usuario->getMessage())->error();
                    return back();
                }
            
            }

            
    }



}
