<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entity\Usuario as Usuario;
use App\Entity\Menu as Menu;
use Yajra\Datatables\Datatables as Datatables;
use Validator;

class MenusController extends Controller {

    public function index(Request $request) {
        return view("menus.index");
    }

    public function getMenus(Request $request)
    {
        $entidad = new Menu();
        return Datatables::of($entidad->getMenus())->make(true);
    }

    public function FormaddMenu(Request $request)
    {
        return view("menus.formaddmenu");
    }

    public function AddMenu(Request $request)
    {
        $entidad = new Menu();
        if ($entidad->AddMenu($request->all())) {
            flash("Exito al guardar!, queda pendiente crear las rutas y activar el menú")->success();
        }else{
            flash("Error al guardar")->error();
        }
        return redirect()->route('menus.index');
    }

    public function ChangestadoMenu(Request $request)
    {
        $entidad = new Menu();
        if ($entidad->ChangestadoMenu($request->all())) {
            flash("Exito al guardar!")->success();
        }else{
            flash("Error al guardar")->error();
        }
        return redirect()->route('menus.index');
    }
}