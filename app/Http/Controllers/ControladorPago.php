<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorPago extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}

	
	public function pagar(Request $request)
	{
		$validacion = Validator::make($request->all(),
		[
			'fecha' => ['required', 'date'],
			'cantiad' => ['required', 'numeric']
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$pago = $validacion->validated();
		$pago['id_persona'] = Auth::user()->id;
		$pago = Pago::create($pago);

		return response()->json($pago, Response::HTTP_OK);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$pago = Pago::all();
		return response()->json($pago, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validacion = Validator::make($request->all(),
		[
			'fecha' => ['required', 'date'],
			'cantidad' 	=> ['required', 'integer'],
			'id_persona' 	=> ['required', 'integer'],
			
		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$pago = $validacion->validated();
		$pago = Pago::create($pago);

		return response()->json($pago, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$pago = Pago::find($id);
		return response()->json($pago, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
		$validacion = Validator::make($request->all(),
		[
			'fecha' => ['required', 'date'],
			'cantidad' 	=> ['required', 'integer'],
			'id_persona' 	=> ['required', 'integer'],

		]);

		if ($validacion->fails())
			return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

		$pago = Pago::find($id);
		$pago->update($validacion->validated());

		return response()->json($pago, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$pago = Pago::find($id);
		$pago->delete();

		return response()->json($pago, Response::HTTP_OK);
    }
}
