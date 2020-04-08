<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Entity\Usuario as Usuario;

class LoginController extends Controller {

    /**
     * Renderizar vista login regular en ambiente de producción
     *
     */
    public function index() {
        if(\Auth::check()){
            return redirect()->route(Usuario::redirectRol(Auth::user()->rol)); 
        }
        return view('login');
    }

    public function attempt(Request $request) {
        $usuario = $request->get('usuario', null);
        $password = $request->get('password', null);

        if (!Auth::attempt(['usuario' => $usuario, 'password' => $password],TRUE)) {
            flash('Usuario o Contraseña errado')->error();
            return redirect()->route('login.index');
        }
        return redirect()->route(Usuario::redirectRol(Auth::user()->rol))->with('popUpLogueo', 1);
    }
    
    function logout(Request $request){
        Auth::logout();
        return redirect()->route('login.index');
    }

}
