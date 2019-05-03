<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    protected $fillable = ['descripcion', 'tramite_id','metodo_id'];

    public function tramite() {
        return $this->belongsTo('App\Tramite');
    }

    public function metodo() {
        return $this->belongsTo('App\Metodo');
    }
}
