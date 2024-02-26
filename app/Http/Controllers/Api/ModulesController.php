<?php

namespace App\Http\Controllers\Api;

use App\Models\Cicle;
use App\Models\Modul;
use App\Models\Usuari;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModulsResource;


class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Modul $moduls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modul $moduls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $moduls)
    {
        //
    }

    public function modulesByCicle(Cicle $cicle){
        $modules = $cicle->moduls;
        return ModulsResource::collection($modules);
    }

    public function modulsMatriculats (Usuari $usuari){
        $moduls = $usuari->moduls;
        return ModulsResource::collection($moduls);
    }
}
