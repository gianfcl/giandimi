<?php
namespace App\Model;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;


class Roles extends Model{
	function getRoles($rol=null)
	{
		$sql=DB::table('ROLES')
			->where('FLG_ACTIVO','1');
		if (!empty($rol)) {
			$sql=$sql->where('ROL','=',$rol);
		}
		return $sql->get();
	}
}