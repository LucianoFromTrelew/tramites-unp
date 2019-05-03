<?php

use Illuminate\Database\Seeder;

use App\Paso;
use App\Tramite;
use App\Metodo;

class PasosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (Tramite::all() as $tramite) {

            for ($i = 0; $i < random_int(3, 30); $i++) {

                $metodo_id = random_int(
                    Metodo::first()->id,
                    Metodo::count()
                );
                Paso::create([
                    'descripcion' => $faker->sentence,
                    'tramite_id' => $tramite->id,
                    'metodo_id' => $metodo_id
                ]);
            }
        }
    }
}
