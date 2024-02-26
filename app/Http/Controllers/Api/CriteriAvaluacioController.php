<?php

namespace App\Http\Controllers\Api;

use App\Models\CriteriAvaluacio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CriteriAvaluacioResource;
use App\Classes\Utilities;
use Illuminate\Database\QueryException;

class CriteriAvaluacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criteri = CriteriAvaluacio::all();
        return CriteriAvaluacioResource::collection($criteri);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $criteri = new CriteriAvaluacio();
        $criteri->ordre = $request->input('ordre');
        $criteri->descripcio = $request->input('descripcio');
        $criteri->actiu = ($request->input('actiu')=='actiu');
        $criteri->resultats_aprenentatge_id = $request->input('resultats_aprenentatge_id');
        try 
        {
            $criteri->save();
            $response = (new CriteriAvaluacioResource($criteri))
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

    /**
     * Display the specified resource.
     */
    public function show(CriteriAvaluacio $criteriAvaluacio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CriteriAvaluacio $criteriAvaluacio)
    {
        $criteriAvaluacio->ordre = $request->input('ordre');
        $criteriAvaluacio->descripcio = $request->input('descripcio');
        $criteriAvaluacio->actiu = ($request->input('actiu')=='actiu');
        $criteriAvaluacio->resultats_aprenentatge_id = $request->input('resultats_aprenentatge_id');
        try 
        {
            $criteriAvaluacio->save();
            $response = (new CriteriAvaluacioResource($criteriAvaluacio))
                        ->response()
                        ->setStatusCode(200);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CriteriAvaluacio $criteriAvaluacio)
    {
        try 
        {
            $criteriAvaluacio->delete();
            $response = (new CriteriAvaluacioResource($criteriAvaluacio))
                        ->response()
                        ->setStatusCode(200);
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
}
