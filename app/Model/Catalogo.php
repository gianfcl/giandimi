<?php
namespace App\Model;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;


class Catalogo extends Model{
	function getProductos()
	{
		$sql=DB::table('TIPO_PRODUCTO')->where('ESTADO','=',DB::Raw('1'))->get();
		return $sql;
	}
}