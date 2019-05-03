<?php

namespace App\Http\Controllers;

use App\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Etiqueta::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $etiqueta = Etiqueta::create($request->all());
        return response()->json($etiqueta, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function show(Etiqueta $etiqueta)
    {
        return $etiqueta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etiqueta $etiqueta)
    {
        $etiqueta->update($request->all());
        return response()->json($etiqueta, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();
        return response()->json(null, 204);
    }

    /**
     * Devuelve los tramites que tengan esa etiqueta
     *
     * @param  \App\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function tramites(Etiqueta $etiqueta)
    {
        return $etiqueta->tramites;
    }
    
}
