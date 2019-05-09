<?php

namespace App\Http\Controllers;

use App\Tramite;
use App\Documento;
use App\Metodo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TramiteController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api")->except([
            'index',
            'show',
            'metodos',
            'pasos',
            'documentos',
            'requerimientos',
            'etiquetas',
            'categoria',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tramite::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tramite = Tramite::create($request->all());
        return response()->json($tramite, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function show(Tramite $tramite)
    {
        return $tramite;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tramite $tramite)
    {
        $tramite->update($request->all());
        return response()->json($tramite, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tramite $tramite)
    {
        $tramite->delete();
        return response()->json(null, 204);
    }

    /**
     * Devuelve los métodos disponibles de un trámite
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function metodos(Tramite $tramite)
    {
        return $tramite->metodosDisponibles();
    }

    /**
     * Devuelve los pasos de un tramite por metodo
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function pasos(Tramite $tramite, Metodo $metodo)
    {
        return $tramite->pasosPorMetodo($metodo);
    }

    /**
     * Devuelve los documentos de un tramite
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function documentos(Tramite $tramite)
    {
        return $tramite->documentos;
    }
    
    /**
     * Devuelve los requerimientos de un tramite
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function requerimientos(Tramite $tramite)
    {
        return $tramite->requerimientos;
    }

    /**
     * Devuelve las etiquetas de un tramite
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function etiquetas(Tramite $tramite)
    {
        return $tramite->etiquetas;
    }

    /**
     * Devuelve la categoria de un tramite
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function categoria(Tramite $tramite)
    {
        return $tramite->categoria;
    }

    /**
     * Agrega un nuevo documento a un tramite
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function documento_store(Request $request, Tramite $tramite)
    {
        if (!$request->filled('documento_id')) {
            return response()->json("No hay documento_id", 400);
        }

        $documento_id = $request->documento_id;

        try {
            $tramite->documentos()->attach($request->documento_id);
            return response()->json($tramite->documentos, 201);
        } catch (QueryException $e) {
            return response()->json("No se pudo agregar el documento", 400);
        }
    }

    /**
     * Agrega un nuevo requerimiento a un tramite
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function requerimiento_store(Request $request, Tramite $tramite)
    {
        if (!$request->filled('requerimiento_id')) {
            return response()->json("No hay requerimiento_id", 400);
        }

        $requerimiento_id = $request->requerimiento_id;

        try {
            $tramite->requerimientos()->attach($request->requerimiento_id);
            return response()->json($tramite->requerimientos, 201);
        } catch (QueryException $e) {
            return response()->json("No se pudo agregar el requerimiento", 400);
        }
    }

    /**
     * Agrega una nueva etiqueta a un tramite
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function etiqueta_store(Request $request, Tramite $tramite)
    {
        if (!$request->filled('etiqueta_id')) {
            return response()->json("No hay etiqueta_id", 400);
        }

        $etiqueta_id = $request->etiqueta_id;

        try {
            $tramite->etiquetas()->attach($request->etiqueta_id);
            return response()->json($tramite->etiquetas, 201);
        } catch (QueryException $e) {
            return response()->json("No se pudo agregar la etiqueta", 400);
        }
    }

    /**
     * Elimina un documento de un tramite
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function documento_destroy(Request $request, Tramite $tramite)
    {
        if (!$request->filled('documento_id')) {
            return response()->json("No hay documento_id", 400);
        }

        $documento_id = $request->documento_id;

        if(!$tramite->documentos()->find($documento_id)) {
            return response()->json("El trámite no tiene el documento agregado", 400);
        }

        $tramite->documentos()->detach($request->documento_id);
        return response()->json($tramite->documentos, 200);
    }

    /**
     * Elimina un requerimiento de un tramite
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function requerimiento_destroy(Request $request, Tramite $tramite)
    {
        if (!$request->filled('requerimiento_id')) {
            return response()->json("No hay requerimiento_id", 400);
        }

        $requerimiento_id = $request->requerimiento_id;

        if(!$tramite->requerimientos()->find($requerimiento_id)) {
            return response()->json("El trámite no tiene el requerimiento agregado", 400);
        }

        $tramite->requerimientos()->detach($request->requerimiento_id);
        return response()->json($tramite->requerimientos, 200);
    }

    /**
     * Elimina una etiqueta de un tramite
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function etiqueta_destroy(Request $request, Tramite $tramite)
    {
        if (!$request->filled('etiqueta_id')) {
            return response()->json("No hay etiqueta_id", 400);
        }

        $etiqueta_id = $request->etiqueta_id;

        if(!$tramite->etiquetas()->find($etiqueta_id)) {
            return response()->json("El trámite no tiene la etiqueta agregada", 400);
        }

        $tramite->etiquetas()->detach($request->etiqueta_id);
        return response()->json($tramite->etiquetas, 200);
    }
}
