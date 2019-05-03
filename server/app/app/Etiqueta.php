<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $fillable = ['descripcion'];

    public function tramites() {
        return $this->belongsToMany('App\Tramite');
    }
}
