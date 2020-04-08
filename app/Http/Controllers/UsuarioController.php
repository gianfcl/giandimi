<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entity\Usuario as Usuario;
use App\Entity\Roles as Roles;
use Yajra\Datatables\Datatables as Datatables;
use Validator;

class UsuarioController extends Controller {

    public function index(Request $request) {
        $roles = new Roles();
        return view("usuarios.index")
            ->with("roles",$roles->getRoles());
    }

    public function getUsuarios(Request $request)
    {
        $entidad = new Usuario();
        return Datatables::of($entidad->getUsuarios())->make(true);
    }

    public function FormAddusuario(Request $request)
    {
        $roles = new Roles();
        return view("usuarios.formaddusuario")
            ->with("roles",$roles->getRoles());
    }

    public function Addusuario(Request $request)
    {
        $entidad = new Usuario();
        if ($entidad->Addusuario($request->all())) {
            flash("Exito al guardar!")->success();
        }else{
            flash("Error al guardar")->error();
        }
        return redirect()->route('usuario.index');
    }

    public function Editusuario(Request $request)
    {
        $entidad = new Usuario();
        if ($entidad->Editusuario($request->all())) {
            flash("Exito al editar!")->success();
        }else{
            flash("Error al editar")->error();
        }
        return redirect()->route('usuario.index');   
    }

    public function Deleteusuario(Request $request)
    {
        $entidad = new Usuario();
        if ($entidad->Deleteusuario($request->all())) {
            flash("Exito al eliminar!")->success();
        }else{
            flash("Error al eliminar")->error();
        }
        return redirect()->route('usuario.index');
    }
}