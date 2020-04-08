<?php
namespace App\Model;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model{
	function getMenus()
	{
		$sql=DB::table('MENU')
			->where('FLG_ACTIVO','1');
		return $sql->get();
	}
}