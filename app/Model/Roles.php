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

	function AddRol($data)
	{
		DB::beginTransaction();
        $status = true;
        try {
            
            DB::table('ROLES')->insert($data);

            DB::commit();
        } catch (\Exception $e) {
            Log::error('BASE_DE_DATOS|' . $e->getMessage());
            $status = false;
            DB::rollback();
        }
        return $status;
	}

	function EditRol($rol,$actualizar)
	{
		DB::beginTransaction();
        $status = true;
        try {
            
            DB::table('ROLES')
            ->where('ROL','=',$rol)
            ->update($actualizar);

            DB::commit();
        } catch (\Exception $e) {
            Log::error('BASE_DE_DATOS|' . $e->getMessage());
            $status = false;
            DB::rollback();
        }
        return $status;
	}
}