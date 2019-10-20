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
    protected $primaryKey ='ID';
					        

        /**
     * The name of the "created at" column.
     *
     * @var string
     */
     public $timestamps = false;
    
    
    protected $fillable = [
        'USUARIO',
        'PASSWORD',
        'ROL',
        'NOMBRE',
        'TOKEN'
        ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'ID',
        'USUARIO',
        'PASSWORD',
        'ROL',
        'NOMBRE',
        'TOKEN'
        ];


    //protected $username = 'REGISTRO';


    public function getAuthPassword () {
        return $this->PASSWORD;
    }


        public function getRememberToken()
    {
        if (! empty($this->TOKEN)) {
            return $this->TOKEN;
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
        if (! empty($this->TOKEN)) {
            $this->TOKEN = $value;
        }
    }

    public function hasRole($rol){
        return in_array($rol, [$this->ROL]);
    }

    static function updateMasive(){
        $usuarios = DB::table('USUARIOS AS WU')->select('WU.USUARIO','WU.CORREO')
        ->where('rol','=',29)
        ->whereNull('PASSWORD')
        ->get();
        //dd($usuarios);
        foreach ($usuarios as $usuario) {
            DB::table('USUARIOS') 
            ->where('USUARIO','=',$usuario->USUARIO)
            ->update(['PASSWORD' => Hash::make($usuario->USUARIO)]);
        }
    }
    
    static function updatePassword($usuario,$password){
        return DB::table('USUARIOS')
             ->where('USUARIO','=',$usuario)
            ->update(['PASSWORD' => Hash::make($password)]);
    }

    public function updateNewPassword($usuario,$password){
        return DB::table('USUARIOS')
             ->where('USUARIO','=',$usuario)
            ->update(['PASSWORD' => Hash::make($password)]);
    }
    
    public function verifyPassword($usuario,$apassword){
        $sql = DB::table('USUARIOS AS WU')
               ->where('WU.USUARIO', '=', $usuario)
               ->where('WU.ESTADO','=','1');
         
        //El usuario encontrado es la primera coincidencia (usuario es unico)     
        $usuario = $sql->first();
        //La función Hash::check() se encarga de confirmar si dos cadenas encriptadas son iguales
        return Hash::check($apassword, $usuario->PASSWORD);
    }
}