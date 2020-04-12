<?php
namespace App\Model;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;


class Roles extends Model{
	function getRoles($activos=false,$rol=null)
	{
		$sql=DB::table("ROLES AS R")
            ->leftjoin(DB::Raw("(SELECT ROL,COUNT(1) AS CANT_M FROM MENU_ROL WHERE FLG_ACTIVO=1 GROUP BY ROL) AS MR"),function ($join)
            {
                $join->on("R.ROL","=","MR.ROL");
            })
            ->select("R.*",DB::Raw("ISNULL(CANT_M,0) as CANT_M"));
        if ($activos) {
			$sql=$sql->where('R.FLG_ACTIVO','1');
        }
		if (!empty($rol)) {
			$sql=$sql->where('R.ROL','=',$rol);
		}
		return $sql->get();
	}

    function getRolesxMenu($activos=false,$rol)
    {
        $sql=DB::table("MENU_ROL as MR")
            ->leftjoin("MENU as M",function ($join)
            {
                $join->on("MR.ID_MENU","=","M.ID");
            })
            ->select("MR.*","M.NOMBRE")
            ->where("MR.ROL","=",$rol);
        if ($activos) {
            $sql=$sql->where("MR.FLG_ACTIVO","=",$activos);
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

    function ChangeEstadoMenuRol($idmenurol,$actualizar)
    {
        DB::beginTransaction();
        $status = true;
        try {
            
            DB::table('MENU_ROL')
            ->where('ID_MENU_ROL','=',$idmenurol)
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