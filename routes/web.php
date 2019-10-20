<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

/*
  Codigos de ROLES (Ver Entidad Usuario)
  ROL_EJECUTIVO_NEGOCIO = 1;
  ROL_ASISTENTE_COMERCIAL = 2;
  ROL_SOPORTE = 4;
  ROL_CALL = 5;
  ROL_GERENTE_TIENDA = 6;
  ROL_GERENTE_CENTRO = 7;
  ROL_GERENTE_ZONA = 8;
  ROL_JEFE_CALL = 9;

 */

Route::get('/testdb', function () {
//    return view('telefonos');
    try {
        DB::connection()->getPdo();
        echo ("Conexión Exitosa!");
    } catch (PDOException $e) {
        echo $e->getMessage();
        die("Could not connect to the database.  Please check your configuration.");
    }
});

Route::get('GestionLeads', 'InicioController@lCargaTablaLeadsog');


/* Rutas públicas */
Route::get('/', ['as' => 'login.index', 'uses' => 'LoginController@index']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
Route::post('/login', ['as' => 'login.attempt', 'uses' => 'LoginController@attempt']);

/* Tipos de Login : COMPLETAR */
Route::get('/demo-login', ['as' => '', 'uses' => 'LoginController@demoLogin']);
Route::post('/demo-attempt', ['as' => '', 'uses' => 'LoginController@demoAttempt']);

/* RUTAS RECUPERACION */
Route::get('/pass-gen', ['as' => 'pass.gen', 'uses' => 'PassController@gen']);
Route::post('/pass-save', ['as' => 'pass.save', 'uses' => 'PassController@save']);
Route::get('/extra-login', ['as' => 'pass.login', 'uses' => 'PassController@login']);
Route::post('/extra-attempt', ['as' => 'pass.attempt', 'uses' => 'PassController@attempt']);


Route::get('/update-massive', ['as' => '', 'uses' => 'ToolsController@updateMasive']);


//RUTA GET PARA MOSTRAR FORMULARIO
Route::get('/pass-change',['as'=>'pass.change','uses'=>'PassController@updatePassForm']);

//RUTA POST PARA ACTUALIZAR CONTRASEÑA
Route::post('/pass-update',['as'=>'pass.update','uses'=>'PassController@updatePassInDatabase']);


Route::group(['prefix' => 'ecosistema', 'middleware' => ['authBase','authRol:20|21|22|23|24|25|26|27|28|29|30|31|999']], function() {
  
});

Route::group(['middleware' => ['authBase','authRol:1|2']], function() {
  Route::get('/productos',['as'=>'productos','uses'=>'CatalogoController@index']);
});

Route::get('/download/{file}',function($file){
    return response()->download(storage_path('app/'.str_replace('|','/',$file)));
})->name('download');