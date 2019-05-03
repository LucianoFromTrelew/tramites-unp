<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metodo extends Model
{
    protected $fillable = ['descripcion'];

    public function pasos() {
        return $this->hasMany('App\Paso');
    }
}
