<?php

namespace App\Entity;

use App\Model\Usuario as mUsuario;
use App\Entity\Roles as Roles;
use App\Model\Menu as mMenu;
use \Illuminate\Pagination\LengthAwarePaginator as Paginator;
use DB;

class Menu extends \App\Entity\Base\Entity {

    protected $_id;
    protected $_nombre;
    protected $_flgsubmenu;
    protected $_flgactivo;
    protected $_prioridad;
    

    function setValues($data) {

        $this->setValue('_id', $data->ID);
        $this->setValue('_nombre', $data->NOMBRE);
        $this->setValue('_flgsubmenu', $data->PASSWORD);
        $this->setValue('_flgactivo', $data->FLG_ACTIVO);
        $this->setValue('_prioridad', $data->PRIORIDAD);
    }

    static function getMenus()
    {
        $entidad = new mMenu();
        return $entidad->getMenus();
    }
}
