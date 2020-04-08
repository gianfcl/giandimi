<?php
namespace App\Model;
use DB;
use Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class Usuario extends Authenticatable{
	protected $table = 'USUARIOS';
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey ='id';
					        

        /**
     * The name of the "created at" column.
     *
     * @var string
     */
     public $timestamps = false;
    
    
    protected $fillable = [
        'nombre',
        'usuario',
        'password',
        'token',
        'rol'
        ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'nombre',
        'usuario',
        'password',
        'token',
        'rol'
        ];


    //protected $username = 'REGISTRO';


    public function getAuthPassword () {
        return $this->password;
    }


    public function getRememberToken(){
        if (! empty($this->token)) {
            return $this->token;
        }
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        if (! empty($this->token)) {
            $this->token = $value;
        }
    }

    public function hasRole($rol){
        return in_array($rol, [$this->rol]);
    }

    static function updatePassword($usuario,$password){
        DB::beginTransaction();
        $status = true;
        try {
            DB::table('USUARIOS')
            ->where('usuario','=',$usuario)
            ->where('password','=',$password)
            ->update(['password' => Hash::make($password)]);

            DB::commit();
        } catch (\Exception $e) {
            Log::error('BASE_DE_DATOS|' . $e->getMessage());
            $status = false;
            DB::rollback();
        }

        return $status;
    }

    function getUsuarios($usuario=null,$password=null)
    {
         $sql = DB::table('USUARIOS AS U')
                ->leftjoin('ROLES AS R',function ($join)
                {
                    $join->on('U.ROL','=','R.ROL');
                })
                ->select('U.*','R.NOMBRE AS nombrerol');
        if (!empty($usuario)) {
            $sql=$sql->where('U.usuario','=',$usuario);
        }
        if(!empty($password)){
            $sql=$sql->where('U.password','=',$password);
        }
            return $sql->get();
    }

    function Addusuario($data)
    {
        DB::beginTransaction();
        $status = true;
        try {
            DB::table('USUARIOS')->insert($data);
            DB::commit();
        } catch (\Exception $e) {
            Log::error('BASE_DE_DATOS|' . $e->getMessage());
            $status = false;
            DB::rollback();
        }
        return $status;
    }
}