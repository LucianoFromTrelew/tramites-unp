<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Metodo;

class Tramite extends Model
{
    protected $fillable = ['titulo', 'descripcion'];

    public function categoria() {
        return $this->belongsTo('App\Categoria');
    }

    public function documentos() {
        return $this->belongsToMany('App\Documento');
    }

    public function requerimientos() {
        return $this->belongsToMany('App\Requerimiento');
    }

    public function etiquetas() {
        return $this->belongsToMany('App\Etiqueta');
    }

    public function pasos() {
        return $this->hasMany('App\Paso');
    }

    public function pasosPorMetodo(Metodo $metodo) {
        $pasos = $this->pasos->where(
            'metodo_id',
            '=',
            $metodo->id
        );
        $res = [];
        foreach ($pasos as $k => $v) {
            array_push($res, $v);
        }
        return $res;
    }

    public function metodosDisponibles() {
        return $this->pasos->map(function ($paso) {
            return $paso->metodo;
        })->unique();
    }
    
}
