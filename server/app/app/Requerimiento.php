<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    protected $fillable = ['descripcion'];

    public function tramites() {
        return $this->belongsToMany('App\Tramite');
    }
}
