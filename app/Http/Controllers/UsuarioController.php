<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entity\Usuario as Usuario;
use Validator;

class UsuarioController extends Controller {

    public function index(Request $request) {  
        return "1";
    }
}
