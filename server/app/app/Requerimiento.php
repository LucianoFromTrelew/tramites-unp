<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    protected $fillable = ['descripcion', 'tramite_id'];

    public function tramites() {
        return $this->belongsToOne('App\Tramite');
    }
}
