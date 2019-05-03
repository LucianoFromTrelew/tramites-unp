<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['descripcion'];

    public function tramites() {
        return $this->hasMany('App\Tramite');
    }
}
