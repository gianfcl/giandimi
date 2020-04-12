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
    protected $_ruta;
    protected $_icon;
    

    function setValues($data) {

        $this->setValue('_id', $data->ID);
        $this->setValue('_nombre', $data->NOMBRE);
        $this->setValue('_flgsubmenu', $data->PASSWORD);
        $this->setValue('_flgactivo', $data->FLG_ACTIVO);
        $this->setValue('_prioridad', $data->PRIORIDAD);
        $this->setValue('_ruta', $data->RUTA);
        $this->setValue('_icon', $data->ICON);
    }

    static function getMenus($activos=false,$data=null)
    {
        $entidad = new mMenu();
        return $entidad->getMenus($activos,$data);
    }

    static function getMenusRol($activos=false,$rol=null)
    {
        $entidad = new mMenu();
        return $entidad->getMenusRol($activos,$rol);
    }

    function AddMenu($data)
    {
        $datos = [
            'NOMBRE'=>strtoupper($data['nombre']),
            'FLG_SUBMENU'=>$data['flgsubmenu'],
            'PRIORIDAD'=>$data['prioridad'],
            'RUTA'=>strtolower($data['nombre']).'.index',
            'ICON'=>$data['icon'],
            'FLG_ACTIVO'=>0
        ];
        $model = new mMenu();
        return $model->AddMenu($datos);
    }

    function ChangestadoMenu($data)
    {
        $model = new mMenu();
        $menu = $model->getMenus(false,$data)->first();
        $actualizar=[
            'FLG_ACTIVO'=>$menu->FLG_ACTIVO==1?0:1,
        ];
        return $model->EditMenu($data['id'],$actualizar);
    }
}
