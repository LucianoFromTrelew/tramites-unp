<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
    protected $fillable = ['descripcion', 'tramite_id'];

    public function tramite() {
        return $this->belongsTo('App\Tramite');
    }

    public function pasos() {
        return $this->hasMany('App\Paso');
    }
}
