<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    protected $fillable = ['descripcion', 'metodo_id'];

    public function metodo() {
        return $this->belongsTo('App\Metodo');
    }
}
