<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorPaquete extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
    
    public function index()
    {
        $paquete = Paquete::all();
		return response()->json($paquete, Response::HTTP_OK);

    }

  
    public function store(Request $request)
    {
		$validacion = Validator::make($request->all(),
		[
			'nombre' => ['required', 'string', 'max:255'],
			'descripcion' 	=> ['required', 'string', 'max:255'],
			'precio' 	=> ['required', 'integer'],

		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$paquete = $validacion->validated();
		$paquete = Paquete::create($paquete);

		return response()->json($paquete, Response::HTTP_OK);

    }

    public function show($id)
    {
		$paquete = Paquete::find($id);
		return response()->json($paquete, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
		$validacion = Validator::make($request->all(),
		[
			'nombre' => ['required', 'string', 'max:255'],
			'descripcion' 	=> ['required', 'string', 'max:255'],
			'precio' 	=> ['required', 'integer'],

		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$paquete = $validacion->validated();
		$paquete = Paquete::find($id);
		$paquete->update($paquete);

		return response()->json($paquete, Response::HTTP_OK);

    }


    public function destroy($id)
    {
		$paquete = Paquete::find($id);
		$paquete->delete();

		return response()->json($paquete, Response::HTTP_OK);
    }
}
