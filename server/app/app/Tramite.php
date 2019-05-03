<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $fillable = ['titulo', 'descripcion'];

    public function subcategoria() {
        return $this->belongsTo('App\Subcategoria');
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

    public function metodos() {
        return $this->hasMany('App\Metodo');
    }
    
}
