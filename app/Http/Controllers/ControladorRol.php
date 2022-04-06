<?php

namespace App\Http\Controllers;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorRol extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
 
    public function index()
    {
		$rol = Rol::all();
		return response()->json($rol, Response::HTTP_OK);

    }


    public function store(Request $request)
    {
		$validacion = Validator::make($request->all(),
		[
			'nombre' => ['required', 'string'],
			'descripcion' 	=> ['required', 'string']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$rol = $validacion->validated();
		$rol = Rol::create($rol);

		return response()->json($rol, Response::HTTP_OK);

    }

  
    public function show($id)
    {
		$rol = Rol::find($id);
		return response()->json($rol, Response::HTTP_OK);

    }

    public function update(Request $request, $id)
    {
		$validacion = Validator::make($request->all(),
		[
			'nombre' => ['required', 'string', 'max:255'],
			'descripcion' 	=> ['required', 'string', 'max:255']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$rol = $validacion->validated();
		$rol = Rol::find($id);
		$rol->update($rol);

		return response()->json($rol, Response::HTTP_OK);

    }

  
    public function destroy($id)
    {
		$rol = Rol::find($id);
		$rol->delete();

    }
}
