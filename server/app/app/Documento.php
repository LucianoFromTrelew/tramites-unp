<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['descripcion'];

    public function tramites() {
        return $this->belongstoMany('App\Tramite');
    }
}
