<?php

use Illuminate\Database\Seeder;

use App\Requerimiento;
use App\Tramite;

class RequerimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $tramite_ids = [];
            for ($j = 0; $j < random_int(0,10); $j++) {
                array_push($tramite_ids, random_int(
                    Tramite::first()->id,
                    Tramite::count()
                ));
            }
            $req = Requerimiento::create([
                'descripcion' => $faker->sentence
            ]);
            $req->tramites()->sync($tramite_ids);
            $req->save();
            
        }
    }
}
