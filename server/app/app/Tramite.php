<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Metodo;
use App\Paso;

class Tramite extends Model
{

    protected $fillable = ['titulo', 'descripcion', 'categoria_id'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($instance) {
            foreach (Metodo::all() as $metodo) {
                $paso = Paso::create([
                    'descripcion' => 'Iniciar tramite',
                    'tramite_id' => $instance->id,
                    'metodo_id' => $metodo->id,
                ]);
            }
        });
    }


    public function categoria() {
        return $this->belongsTo('App\Categoria');
    }

    public function documentos() {
        return $this->belongsToMany('App\Documento');
    }

    public function requerimientos() {
        return $this->hasMany('App\Requerimiento');
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
