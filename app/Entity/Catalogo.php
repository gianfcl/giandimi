<?php

namespace App\Entity;

use App\Model\Catalogo as mCatalogo;

class Catalogo extends \App\Entity\Base\Entity {
	function getProductos()
	{
		$model=new mCatalogo();
		return $model->getProductos();
	}

	function getEmpresas()
	{
		$model=new mCatalogo();
		return $model->getEmpresas();
	}

	static function getTabla($data=null)
	{
		if (isset($data['nombre']) && $data['nombre']!=null) {
			$filtro['nombre'] = $data['nombre'];
		}
		if (isset($data['descripcion']) && $data['descripcion']!=null) {
			$filtro['descripcion'] = $data['descripcion'];
		}
		if (isset($data['id_empresa']) && $data['id_empresa']!=null) {
			$filtro['id_empresa'] = $data['id_empresa'];
		}
		$model=new mCatalogo();
		return $model->getTabla(isset($filtro) ? $filtro : null);
	}

	function EditArticulo($data)
	{
		$producto=[
			'nombre'=>$data['nombre'],
			'descripcion'=>$data['descripcion'],
			'id_empresa_fabricantes'=>$data['empresa'],
			'estado'=>1,
		];
		if (!empty($data['id'])) {
			$producto['id']=$data['id'];
			$model=new mCatalogo();
			return $model->UpadteArticulo($producto);
		}else{

			$model=new mCatalogo();
			return $model->AddArticulo($producto);
		}
	}

}