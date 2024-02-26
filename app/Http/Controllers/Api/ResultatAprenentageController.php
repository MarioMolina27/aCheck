<?php

namespace App\Http\Controllers\Api;

use App\Classes\Utilities;
use Illuminate\Http\Request;
use App\Models\ResultatAprenentage;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\ResultatAprenentageResource;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ResultatAprenentageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultatAprenentages = ResultatAprenentage::all();
        return ResultatAprenentageResource::collection($resultatAprenentages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultatAprenentage = new ResultatAprenentage();
        $resultatAprenentage->ordre = $request->input('ordre');
        $resultatAprenentage->descripcio = $request->input('descripcio');
        $resultatAprenentage->actiu = ($request->input('actiu')=='actiu');
        $resultatAprenentage->moduls_id = $request->input('moduls_id');
        try 
        {
            $resultatAprenentage->save();
            $response = (new ResultatAprenentageResource($resultatAprenentage))
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
    public function show(ResultatAprenentage $resultatAprenentage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResultatAprenentage $resultatAprenentage)
    {
        $resultatAprenentage->ordre = $request->input('ordre');
        $resultatAprenentage->descripcio = $request->input('descripcio');
        $resultatAprenentage->actiu = ($request->input('actiu')=='actiu');
        $resultatAprenentage->moduls_id = $request->input('moduls_id');
        try 
        {
            $resultatAprenentage->save();
            $response = (new ResultatAprenentageResource($resultatAprenentage))
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
    public function destroy(ResultatAprenentage $resultatAprenentage)
    {
        try 
        {
            $resultatAprenentage->delete();
            $response = \response()
                        ->json(['message' => 'Resultat d\'aprenentatge eliminat correctament'], 200);
        }
        catch (\Exception $ex) 
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

    public function getResultatsByModul($modulId,$idUser)
    {
        $resultatAprenentages = ResultatAprenentage::with([
            'criterisAvaluacio', 
            'criterisAvaluacio.rubrica', 
            'criterisAvaluacio.usuari_has_criterisAvaluacio' => function (Builder $query) use ($idUser){
                $query->where('id', $idUser)->withPivot('nota');
            }
        ])->where('moduls_id', $modulId)->get();

        return ResultatAprenentageResource::collection($resultatAprenentages);
    }
}
