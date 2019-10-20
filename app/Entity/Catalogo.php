<?php

namespace App\Entity;

use App\Model\Catalogo as mCatalogo;

class Catalogo extends \App\Entity\Base\Entity {
	function getProductos()
	{
		$model=new mCatalogo();
		return $model->getProductos();
	}

}