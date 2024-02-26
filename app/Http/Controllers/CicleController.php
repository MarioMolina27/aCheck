<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use Illuminate\Http\Request;
use App\Models\TipusUsuari;

class CicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
    public function show(Cicle $cicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cicle $cicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cicle $cicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cicle $cicle)
    {
        //
    }

    // public function modulesByCicle(Request $request)
    // {
    //     $tipus_usuaris = TipusUsuari::where('actiu', true)->get();
    //     $cicles = Cicle::where('actiu', true)->get();

    //     $cicle = Cicle::find($request->cicleSelect);
    //     $modules = $cicle->moduls;

    //     $request->flash();


    //     return view('usuaris.create', compact('tipus_usuaris', 'cicles', 'modules'));
    // }
}
