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


/* RUTAS RECUPERACION */
Route::get('/pass-gen', ['as' => 'pass.gen', 'uses' => 'PassController@gen']);
Route::post('/pass-save', ['as' => 'pass.save', 'uses' => 'PassController@save']);


Route::group(['middleware' => ['authBase','authRol:1|2']], function() {
  Route::get('/productos',['as'=>'productos','uses'=>'CatalogoController@index']);
  Route::get('/productos/editarticulo',['as'=>'productos.editarticulo','uses'=>'CatalogoController@editarticulo']);
  Route::post('/productos/datables',['as'=>'productos.datables','uses'=>'CatalogoController@gettablaplugin']);
  Route::get('/productos2',['as'=>'productos2','uses'=>'CatalogoController@tablaplugin']);
});

Route::get('/download/{file}',function($file){
    return response()->download(storage_path('app/'.str_replace('|','/',$file)));
})->name('download');

Route::group(['middleware' => ['authBase','authRol:1|2']], function() {
  Route::get('/usuarios',['as'=>'usuario.index','uses'=>'UsuarioController@index']);
  Route::get('/getusuarios',['as'=>'usuario.getUsuarios','uses'=>'UsuarioController@getUsuarios']);
  Route::get('/formaddusuario',['as'=>'formaddusuario','uses'=>'UsuarioController@FormAddusuario']);
  Route::get('/addusuario',['as'=>'addusuario','uses'=>'UsuarioController@Addusuario']);
  Route::get('/editar',['as'=>'usuarios.editar','uses'=>'UsuarioController@Editusuario']);
  Route::get('/usuestado',['as'=>'usuario.estado','uses'=>'UsuarioController@ChangeEstadousuario']);

  Route::get('/roles',['as'=>'roles.index','uses'=>'RolesController@index']);
  Route::get('/getRoles',['as'=>'roles.getRoles','uses'=>'RolesController@getRoles']);
  Route::get('/addrol',['as'=>'roles.addrol','uses'=>'RolesController@Addrol']);
  Route::get('/formroles',['as'=>'roles.formroles','uses'=>'RolesController@formroles']);
  Route::get('/rolestado',['as'=>'roles.estado','uses'=>'RolesController@ChangeEstadoRol']);

  Route::get('/rolesxmenu',['as'=>'roles.rolesxmenu','uses'=>'RolesController@getRolesxMenu']);
  Route::get('/estadorm',['as'=>'roles.estadorm','uses'=>'RolesController@ChangeEstadoMenuRol']);
});

Route::group(['middleware' => ['authBase','authRol:1|2']], function() {
  Route::get('/menus',['as'=>'menus.index','uses'=>'MenusController@index']);
  Route::get('/getmenus',['as'=>'menus.getMenus','uses'=>'MenusController@getMenus']);
  Route::get('/formmenu',['as'=>'menu.formmenu','uses'=>'MenusController@FormaddMenu']);
  Route::get('/menuestado',['as'=>'menu.estado','uses'=>'MenusController@ChangestadoMenu']);

  Route::get('/addmenu',['as'=>'menu.add','uses'=>'MenusController@AddMenu']);
});

Route::group(['middleware' => ['authBase','authRol:1|2|3']], function() {
  Route::get('/servicios',['as'=>'servicios.index','uses'=>'ServiciosController@index']);
});