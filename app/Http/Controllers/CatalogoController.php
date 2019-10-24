<?php 
namespace App\Http\Controllers;

use App\Entity\Catalogo as Catalogo;
use Illuminate\Http\Request;
use Validator;

class CatalogoController extends Controller{
	public function index()
	{
		$entidad=new Catalogo();
		return view("productos")
				->with('productos',$entidad->getProductos());
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
}

?>