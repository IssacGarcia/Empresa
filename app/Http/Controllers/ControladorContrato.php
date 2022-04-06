<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorContrato extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}

  
    public function index()
    {
		$contrato = Contrato::all();
		return response()->json($contrato, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
		$validacion = Validator::make($request->all(),
		[
			'fecha_inicio' => ['required', 'date'],
			'fecha_corte' => ['required', 'date']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$contrato = $validacion->validated();
		$contrato = Contrato::create($contrato);

		return response()->json($contrato, Response::HTTP_OK);
    }

    public function show($id)
    {
		$contrato = Contrato::find($id);
		return response()->json($contrato, Response::HTTP_OK);
    }

  
    public function update(Request $request, $id)
    {
		$validacion = Validator::make($request->all(),
		[
			'fecha_inicio' => ['date'],
			'fecha_corte' => ['date']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
		
		$contrato = Contrato::find($id);
		$contrato->update($validacion->validated());

		return response()->json($contrato, Response::HTTP_OK);
    }


    public function destroy($id)
    {
		$contrato = Contrato::find($id);
		$contrato->delete();

		return response()->json($contrato, Response::HTTP_OK);
    }
}