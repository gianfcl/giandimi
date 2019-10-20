<?php 
namespace App\Http\Controllers;

use App\Entity\Catalogo as Catalogo;

class CatalogoController extends Controller{
	public function index()
	{
		$entidad=new Catalogo();
		return view("productos")
				->with('productos',$entidad->getProductos());
	}
}

?>