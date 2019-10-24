<?php

namespace App\Entity;

use App\Model\Catalogo as mCatalogo;

class Catalogo extends \App\Entity\Base\Entity {
	function getProductos()
	{
		$model=new mCatalogo();
		return $model->getProductos();
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