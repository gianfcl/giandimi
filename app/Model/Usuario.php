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

    static function updateMasive(){
        $usuarios = DB::table('USUARIOS AS WU')->select('WU.usuario','WU.correo')
        ->where('rol','=',29)
        ->whereNull('password')
        ->get();
        //dd($usuarios);
        foreach ($usuarios as $usuario) {
            DB::table('USUARIOS') 
            ->where('usuario','=',$usuario->usuario)
            ->update(['password' => Hash::make($usuario->usuario)]);
        }
    }
    
    static function updatePassword($usuario,$password){
        return DB::table('USUARIOS')
             ->where('usuario','=',$usuario)
            ->update(['password' => Hash::make($password)]);
    }

    public function updateNewPassword($usuario,$password){
        return DB::table('USUARIOS')
             ->where('usuario','=',$usuario)
            ->update(['password' => Hash::make($password)]);
    }
    
    public function verifyPassword($usuario,$apassword){
        $sql = DB::table('USUARIOS AS WU')
               ->where('WU.usuario', '=', $usuario)
               ->where('WU.estado','=','1');
         
        //El usuario encontrado es la primera coincidencia (usuario es unico)     
        $usuario = $sql->first();
        //La función Hash::check() se encarga de confirmar si dos cadenas encriptadas son iguales
        return Hash::check($apassword, $usuario->PASSWORD);
    }
}