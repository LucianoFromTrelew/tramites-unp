<?php

use Illuminate\Database\Seeder;
use App\Etiqueta;
use App\Tramite;

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
            $tramite_ids = [];
            for ($j = 0; $j < random_int(0,10); $j++) {
                array_push($tramite_ids, random_int(
                    Tramite::first()->id,
                    Tramite::count()
                ));
            }

            $et = Etiqueta::create([
                'descripcion' => $etiqueta
            ]);
            $et->tramites()->sync($tramite_ids);
            $et->save();
        }
    }
}
