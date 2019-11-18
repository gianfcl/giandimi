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

	function getEmpresas()
	{
		$sql=DB::table('EMPRESAS')
				->where('estado','=',DB::Raw('1'))
				->get();
		return $sql;
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

	function getTabla($data=null)
	{
		$sql=DB::table('TIPO_PRODUCTOS as TP')
				->leftjoin('EMPRESAS as EM',function($join)
				{
					$join->on('EM.id_empresa','=','TP.id_empresa_fabricantes');
					$join->on('EM.estado','=',DB::Raw('1'));
				})
				->where('TP.estado','=',DB::Raw('1'));
		if ($data!=null) {
			if (isset($data['nombre']) && $data['nombre']) {
				$sql=$sql->where('TP.nombre',$data['nombre']);
			}
			if (isset($data['descripcion']) && $data['descripcion']) {
				$sql=$sql->whereIn('TP.descripcion',$data['descripcion']);
			}
			if (isset($data['id_empresa']) && $data['id_empresa']) {
				$sql=$sql->whereIn('TP.id_empresa_fabricantes',$data['id_empresa']);
			}
		}
		return $sql;
	}
}