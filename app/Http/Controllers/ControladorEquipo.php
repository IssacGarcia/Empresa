<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorEquipo extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
    public function index()
    {
		$equipo = Equipo::all();
		return response()->json($equipo, Response::HTTP_OK);

    }
 
    public function store(Request $request)
    {
		$validacion = Validator::make($request->all(),
		[
			'modelo' => ['required', 'string', 'max:255'],
		'descripcion' 	=> ['required', 'string', 'max:255'],
		'id_persona' 	=> ['required', 'integer'],
		'id_trabajo' 	=> ['required', 'integer']
		]);
		
		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$equipo = $validacion->validated();
		$equipo = Equipo::create($equipo);

		return response()->json($equipo, Response::HTTP_OK);
    }


    public function show($id)
    {
		$equipo = Equipo::find($id);
		return response()->json($equipo, Response::HTTP_OK);

    }

 
    public function update(Request $request, $id)
    {
		$validacion = Validator::make($request->all(),
		[
			'modelo' => ['required', 'string', 'max:255'],
		'descripcion' 	=> ['required', 'string', 'max:255'],
		'id_persona' 	=> ['required', 'integer'],
		'id_trabajo' 	=> ['required', 'integer']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$equipo = Equipo::find($id);
		$equipo->update($validacion->validated());

		return response()->json($equipo, Response::HTTP_OK);
    }

 
    public function destroy($id)
    {
		$equipo = Equipo::find($id);
		$equipo->delete();

		return response()->json($equipo, Response::HTTP_OK);
    }
}
