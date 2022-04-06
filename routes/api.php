<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth']], function()
{
	Route::resource('personas', ControladorPersona::class);
});


Route::prefix('persona')->group(function()
{
	Route::post('cuentas', 'ControladorLogin@cuentas');
	Route::post('cuenta', 'ControladorLogin@cuenta');
	Route::post('ingresar', 'ControladorLogin@ingresar');
	Route::post('salir', 'ControladorLogin@salir');
	Route::post('registrarse', 'ControladorLogin@registrarse');
	Route::post('editar', 'ControladorLogin@editar');
	Route::post('borrar', 'ControladorLogin@borrar');
	Route::post('refrescar', 'ControladorLogin@refrescar');
});




Route::any('no_autorizado', function()
{
	return response()->json(['error' => 'No Autorizado'], Response::HTTP_UNAUTHORIZED);
})
->name('no_autorizado');

//Manera de mandar a llamar tus metodos desde el controlador usando los metodos get, post, put, delete

Route::resource('contrato', ControladorContrato::class);

Route::resource('equipo', ControladorEquipo::class);

Route::resource('material', ControladorMaterial::class);

Route::resource('pago', ControladorPago::class);

Route::resource('paquete', ControladorPaquete::class);

Route::resource('rol', ControladorRol::class);

Route::resource('trabajo', ControladorTrabajo::class);

/* Cuantos equipos hay por cliente */
Route::get('xpersona/{id}', [ControladorConsultas::Class,'EquiposPorPersona']);	
//Cuantos paquetes hay por cliente
Route::get('xpaquete/{id}', [ControladorConsultas::Class,'PaquetesPorPersona']);

Route::post('rolxpersona', [ControladorConsultas::Class,'AsignarRol']);

Route::post('paqxpersona', [ControladorConsultas::Class,'AsignarPaquete']);

Route::get('xmaterial/{id}', [ControladorConsultas::Class,'MaterialPorTrabajo']);

//Me muestra los materiales locales en existencia
Route::get('materials', [ControladorConsultas::Class,'MaterialSinUsar']);



