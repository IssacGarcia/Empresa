<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorMaterial extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
    
    public function index()
    {
        $material = Material::all();
		return response()->json($material, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
		$validacion = Validator::make($request->all(),
		[
			'modelo' => ['required', 'string', 'max:255'],
			'descripcion' 	=> ['required', 'string', 'max:255'],
			'id_trabajo' 	=> ['integer']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$material = $validacion->validated();
		$material = Material::create($material);

		return response()->json($material, Response::HTTP_OK);
  }
    public function show($id)
    {
		$material = Material::find($id);
		return response()->json($material, Response::HTTP_OK);

    }

    public function update(Request $request, $id)
    {
		$validacion = Validator::make($request->all(),
		[
			'modelo' => ['required', 'string', 'max:255'],
			'descripcion' 	=> ['required', 'string', 'max:255'],
			'id_trabajo' 	=> [ 'integer']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$material = $validacion->validated();
		$material = Material::find($id);
		$material->update($material);

		return response()->json($material, Response::HTTP_OK);
    }
    public function destroy($id)
    {
		$material = Material::find($id);
		$material->delete();

		return response()->json($material, Response::HTTP_OK);
    }
}
