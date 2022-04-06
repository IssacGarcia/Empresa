<?php

namespace App\Http\Controllers;


use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorTrabajo extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
    
    public function index()
    {
        $trabajo = Trabajo::all();
		return response()->json($trabajo, Response::HTTP_OK);
    }

 


  
    public function store(Request $request)
    {
		$validacion = Validator::make($request->all(),
		[
			'descripcion' => ['required', 'string', 'max:255'],
			'estatus' 	=> ['required', 'string', 'max:255'],
		
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$trabajo = $validacion->validated();
		$trabajo = Trabajo::create($trabajo);

		return response()->json($trabajo, Response::HTTP_OK);

    }


    public function show($id)
    {
        $trabajo = Trabajo::find($id);
            return response()->json($trabajo, Response::HTTP_OK);
    }

  
    public function update(Request $request, $id)
    {
		$validacion = Validator::make($request->all(),
		[
			'descripcion' => ['required', 'string', 'max:255'],
			'estatus' 	=> ['required', 'string', 'max:255'],

		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$trabajo = $validacion->validated();
		$trabajo = Trabajo::find($id);
		$trabajo->update($trabajo);

		return response()->json($trabajo, Response::HTTP_OK);

    }

    
    public function destroy($id)
    {
		$rol = Trabajo::find($id);
		$rol->delete();
    }
}
