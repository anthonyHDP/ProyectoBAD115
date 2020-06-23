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

Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('/privilegio', 'PrivilegioController@index');
Route::post('/privilegio/registrar', 'PrivilegioController@store');
Route::put('/privilegio/actualizar', 'PrivilegioController@update');
Route::put('/privilegio/eliminar', 'PrivilegioController@destroy');

Route::get('/rol', 'RolController@index');
Route::post('/rol/registrar', 'RolController@store');
Route::put('/rol/actualizar', 'RolController@update');
Route::put('/rol/eliminar', 'RolController@destroy');

Route::get('/usuario', 'UsuarioController@index');
Route::post('/usuario/registrar', 'UsuarioController@store');
Route::put('/usuario/actualizar', 'UsuarioController@update');
Route::put('/usuario/eliminar', 'UsuarioController@destroy');
Route::get('/rol/selectRoles', 'UsuarioController@selectRoles');
Route::get('/empleado/selectEmpleado', 'UsuarioController@selectEmpleados');

Route::post('/rolprivilegio/registrar', 'Roles_PrivilegiosController@store');
Route::get('/empleado/selectEmpleado', 'UsuarioController@selectEmpleados');
Route::post('/empleado','EmpleadoController@index');
Route::post('/empleado/registrar','EmpleadoController@store');
Route::put('/empleado/actualizar','EmpleadoController@update');
Route::put('/empleado/desactivar','EmpleadoController@desactivar');
Route::put('/empleado/activar','EmpleadoController@activar');
Route::get('/profesiones/selectProfesion', 'EmpleadoController@selectProfesion');

Route::get('/estados_civiles/selectEstadoCivil', 'EmpleadoController@selectEstadoCivil');
Route::get('/generos/selectGenero', 'EmpleadoController@selectGenero');
Route::get('/contactos_telefonicos/selectContacto', 'EmpleadoController@selectContacto');
Route::get('/direccion_municipio/selectDireccionMunicipio', 'EmpleadoController@selectDireccionMunicipio');
Route::get('/direccion_departamento/selectDireccionDepartamento', 'EmpleadoController@selectDireccionDepartamento');
Route::get('/tipos_identificacion/selectIdentificacion', 'EmpleadoController@selectIdentificacion');
Route::get('/tipo_contacto_telefonico/selectContacto', 'EmpleadoController@selectContacto');
Route::get('/empleados/selectEmpleado', 'EmpleadoController@selectEmpleado');

Route::post('/contrato/registrar','ContratoController@store');
Route::put('/contrato/actualizar','ContratoController@update');
Route::put('/contrato/activar','ContratoController@activar');