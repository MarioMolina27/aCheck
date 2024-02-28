<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuari;
use App\Models\CriteriAvaluacio;
use App\Classes\Utilities;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Resources\UsuariResource;
use App\Http\Controllers\Controller;


class UsuariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = Usuari::all();
        return UsuariResource::collection($usuaris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuari $usuari)
    {


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuari $usuari)
    {

    }

    public function matricular(Request $request, Usuari $usuari)
    {
        $modul = $request->input('modul');

        try {
            $usuari->moduls()->attach($modul);
            $response = (new UsuariResource($usuari))
                ->response()
                ->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilities::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);
        } finally {
            return $response;
        }
    }

    public function desmatricular(Request $request, Usuari $usuari)
    {
        $modul = $request->input('modul');

        try {
            $usuari->moduls()->detach($modul);
            $response = (new UsuariResource($usuari))
                ->response()
                ->setStatusCode(201);
        } catch (QueryException $ex) {
            $mensaje = Utilities::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);
        } finally {
            return $response;
        }
    }

    public function updateCriteriNota(Request $request, Usuari $usuari, CriteriAvaluacio $criteri)
    {
        $nota = $request->input('nota');
        try 
        {
            $usuari->criterisAvaluacio()->updateExistingPivot($criteri->id, ['nota' => $nota]);
            $response = (new UsuariResource($usuari))
                ->response()
                ->setStatusCode(201);
        } 
        catch (QueryException $ex) 
        {
            $mensaje = Utilities::errorMessage($ex);
            $response = \response()
                ->json(['error' => $mensaje], 400);
        } 
        finally 
        {
            return $response;
        }
    }

    public function getAllAlumnes()
    {
        $alumnes = Usuari::where('tipus_usuaris_id', 3)->get();
        return UsuariResource::collection($alumnes);
    }

    public function getAllAlumnesByModul($modul)
    {
        $alumnes = Usuari::where('tipus_usuaris_id', 3)->whereHas('moduls', function ($query) use ($modul) {
            $query->where('moduls.id', $modul);
        })->get();
        return UsuariResource::collection($alumnes);
    }
}
