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

        for ($i = 0; $i < 100; $i++) {
            $req = Requerimiento::create([
                'descripcion' => $faker->sentence,
                'tramite_id' => random_int(
                    Tramite::first()->id,
                    Tramite::count()
                )
            ]);
        }
    }
}
