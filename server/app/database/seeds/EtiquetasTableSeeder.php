<?php

use Illuminate\Database\Seeder;
use App\Etiqueta;

class EtiquetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etiquetas = [
            'personal', 
            'bienestar', 
            'ingenieria', 
            'sistemas', 
            'ingresantes',
            'graduados',
            'reincorporacion',
            'urgente',
            'atencion',
            'importante'
        ];

        foreach ($etiquetas as $etiqueta) {
            Etiqueta::create([
                'descripcion' => $etiqueta
            ]);
        }
    }
}
