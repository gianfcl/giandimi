<?php
namespace App\Model;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model{
	function getMenus($activo=false,$data=null)
	{
		$sql=DB::table('MENU');
		if ($activo) {
			$sql=$sql->where('FLG_ACTIVO','1');
		}
        if (!empty($data)) {
            $sql=$sql->where('ID','=',$data['id']);
        }
		return $sql->get();
	}

    function getMenusRol($activo=false,$rol=null)
    {
        $sql=DB::table("MENU_ROL AS MR")
            ->leftjoin("MENU AS M",function($join)
            {
                $join->on("MR.ID_MENU","=","M.ID");
            })
            ->select("M.*");
        if (!empty($rol)) {
            $sql=$sql->where("MR.ROL","=",$rol);
        }
        if ($activo) {
            $sql=$sql->where("MR.FLG_ACTIVO","=","1")
                    ->where("M.FLG_ACTIVO","=","1");
        }
        return $sql->get();
    }

	function AddMenu($data)
	{
		DB::beginTransaction();
        $status = true;
        try {
            
            DB::table('MENU')->insert($data);

            DB::commit();
        } catch (\Exception $e) {
            Log::error('BASE_DE_DATOS|' . $e->getMessage());
            $status = false;
            DB::rollback();
        }
        return $status;
	}

	function EditMenu($id,$actualizar)
	{
		DB::beginTransaction();
        $status = true;
        try {
            
            DB::table('MENU')
            ->where('ID','=',$id)
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