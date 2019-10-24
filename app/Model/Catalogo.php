<?php
namespace App\Model;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;


class Catalogo extends Model{
	function getProductos()
	{
		$sql=DB::table('TIPO_PRODUCTOS as TP')
				->leftjoin('EMPRESAS as EM',function($join)
				{
					$join->on('EM.id_empresa','=','TP.id_empresa_fabricantes');
					$join->on('EM.estado','=',DB::Raw('1'));
				})
				->where('TP.estado','=',DB::Raw('1'))->get();
		return $sql;
	}
	function AddArticulo($producto)
	{
		$sql=DB::table('TIPO_PRODUCTOS')->insert($producto);
		return ($sql) ? '1' : '0';
	}
	function UpadteArticulo($producto)
	{
		$sql=DB::table('TIPO_PRODUCTOS')
				->where('id','=',$producto['id'])
				->update([
							'nombre'=>$producto['nombre'],
							'descripcion'=>$producto['descripcion']
						]);
		return ($sql) ? '2' : '0';
	}
}