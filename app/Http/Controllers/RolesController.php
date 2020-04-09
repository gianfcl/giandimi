<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entity\Usuario as Usuario;
use App\Entity\Roles as Roles;
use Yajra\Datatables\Datatables as Datatables;
use Validator;

class RolesController extends Controller {

    public function index(Request $request) {
        return view("usuarios.roles");
    }

    public function getRoles(Request $request)
    {
        $entidad = new Roles();
        return Datatables::of($entidad->getRoles())->make(true);
    }

    public function formroles(Request $request)
    {
        return view("usuarios.formaddroles");
    }

    public function Addrol(Request $request)
    {
        $entidad = new Roles();
        if ($entidad->Addrol($request->all())) {
            flash("Exito al guardar!")->success();
        }else{
            flash("Error al guardar")->error();
        }
        return redirect()->route('roles.index');
    }

    public function ChangeEstadoRol(Request $request)
    {
        $entidad = new Roles();
        if ($entidad->ChangeEstadoRol($request->all())) {
            flash("Exito al guardar!")->success();
        }else{
            flash("Error al guardar")->error();
        }
        return redirect()->route('roles.index');
    }
}