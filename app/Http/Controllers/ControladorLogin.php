<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorLogin extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['ingresar', 'registrarse']]);
	}

	// public function hacer_trabajo(Request $request)
		// agrego un trabajo (CRUD Trabajo)
		// edito el "id_persona" del equipo instalado (CRUD Equipo)
	// public function contratar(Request $request)
	// public function descontratar(Request $request)


	// Cuentas
	public function Cuentas()
	{
		$persona = Persona::all();
		return response()->json($persona, Response::HTTP_OK);
	}

	// Cuenta
	public function cuenta()
	{
		$persona = Auth::user();
		return response()->json($persona, Response::HTTP_OK);
	}

	// Ingresar
	public function ingresar(Request $request)
	{
		$validacion = Validator::make($request->all(),
		[
			'email' => ['required', 'email'],
			'password' => ['required', 'string', 'min:4']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		if (!$token = Auth::attempt($validacion->validated()))
			return redirect('api/no_autorizado');

		return $this->crear_nuevo_token($token);
	}

	// Registrarse
	public function registrarse(Request $request)
	{
		$validacion = Validator::make($request->all(),
		[
			'nombre' => ['string'],
			'apellido_paterno' => ['string'],
			'apellido_materno' => ['string'],
			'email' => ['required', 'email', 'unique:Persona'],
			'password' => ['required', 'string', 'min:4'],
			'telefono' => ['string'],
			'pais' => ['string'],
			'estado' => ['string'],
			'ciudad' => ['string'],
			'dirreccion' => ['string']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$persona = $validacion->validated();
		$persona['password'] = Hash::make($persona['password']);
		$persona = Persona::create($persona);
		$token = Auth::login($persona);

		return $this->crear_nuevo_token($token);
	}

	// Salir
	public function salir(Request $request)
	{
		Auth::logout();
		return response()->json(['mensaje' => 'Sesion Finalizada']);
	}

	// Editar
	public function editar(Request $request)
	{
		$persona = Auth::user();
		if ($request->password)
			$request['password'] = Hash::make($request->password);
		$persona->update($request->all());
		return response()->json($persona, Response::HTTP_OK);
	}

	// Borrar
	public function borrar()
	{
		Auth::user()->delete();
		return response()->json(null, Response::HTTP_NO_CONTENT);
	}

	// Refrescar
	public function refrescar()
	{
		return $this->crear_nuevo_token(Auth::refresh());
	}

	// Crea un nuevo token de sesion
	protected function crear_nuevo_token($token)
	{
		return response()->json(
		[
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => Auth::factory()->getTTL() * 60
		]);
	}

/*crear metodo Material de equipos por clientes*/
}