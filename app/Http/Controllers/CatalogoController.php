<?php 
namespace App\Http\Controllers;

use App\Entity\Catalogo as Catalogo;
use Yajra\Datatables\Datatables as Datatables;
use Illuminate\Http\Request;
use Validator;

class CatalogoController extends Controller{
	public function index()
	{
		$entidad=new Catalogo();
		return view("productos")
				->with('productos',$entidad->getProductos())
				->with('empresas',$entidad->getEmpresas());
	}
	public function editarticulo(Request $request)
	{
		$entidad=new Catalogo();
		if ($entidad->EditArticulo($request->all())=='1') {
			flash('Se agrego el producto');
			return redirect()->route('productos');
		}else if($entidad->EditArticulo($request->all())=='2'){
			flash('Se actualizo el producto');
			return redirect()->route('productos');
		}else{
			flash('No se pudo agregar el producto');
			return redirect()->route('productos');
		}
	}

	public function peru()
	{
		return view ('mapa');
	}

	public function tablaplugin()
	{
		return view ('productos_2');
	}

	public function gettablaplugin(Request $request)
	{
		return Datatables::of(Catalogo::getTabla($request->all()))->make(true);
	}
}

?>