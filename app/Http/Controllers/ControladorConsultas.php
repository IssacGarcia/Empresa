<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Persona;
use App\Models\Trabajo;
use App\Models\Material;
use App\Models\Paquete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ControladorConsultas extends Controller
{
    /** Muestra el numero de equipos del usuario */
    public function EquiposPorPersona($id)
    {
        $equipo = Equipo::where('id_persona', $id)->count();
        return response()->json([$equipo => 'equipos'], Response::HTTP_OK);
    }

    /** administrar los paquetes por persona */
    public function PaquetesPorPersona($id)
    {
        $paquetes = Persona::where('id_paquete', $id)->count();
        return response()->json([$paquetes => 'paquetes'], Response::HTTP_OK);
    }


    /** Asigna un rol al usuario */
    public function AsignarRol(Request $request)
    {
        $validacion = Validator::make($request->all(),
            [
                'id_rol' => ['required', 'integer'],
            ]);

        if ($validacion->fails())
            return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

        $datos = $validacion->validated();
        $persona = Auth::user();
        $persona->id_rol = $datos['id_rol'];
        $persona->save();

        return response()->json($persona, Response::HTTP_OK);
    }

    public function AsignarPaquete(Request $request)
    {
        $validacion = Validator::make($request->all(),
            [
                'id_paquete' => ['required', 'integer'],
            ]);

        if ($validacion->fails())
            return response()->json($validacion->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);

        $datos = $validacion->validated();
        $persona = Auth::user();
        $persona->id_paquete = $datos['id_paquete'];
        $persona->save();

        return response()->json($persona, Response::HTTP_OK);
    }

    /** Material utilizado en los Trabajo */
    public function MaterialPorTrabajo($id)
    {
        $material = Trabajo::where('id_trabajo', $id)->count();
        return response()->json([$material => 'materiales'], Response::HTTP_OK);
    }

    /** Material sin id_trabajo */
    public function MaterialSinUsar()
    {
        $material = Material::whereNull('id_trabajo')->get();
        return response()->json(['materiales'=> $material ], Response::HTTP_OK);
    }
    
 
    
}
