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
        return DB::table('USUARIOS')
             ->where('usuario','=',$usuario)
            ->update(['password' => Hash::make($password)]);
    }
}