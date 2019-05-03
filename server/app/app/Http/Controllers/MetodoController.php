<?php

namespace App\Http\Controllers;

use App\Metodo;
use Illuminate\Http\Request;

class MetodoController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Metodo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $metodo = Metodo::create($request->all());
        return response()->json($metodo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function show(Metodo $metodo)
    {
        return $metodo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metodo $metodo)
    {
        $metodo->update($request->all());
        return response()->json($metodo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metodo $metodo)
    {
        $metodo->delete();
        return response()->json(null, 204);
    }
}
