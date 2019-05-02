<?php

use Illuminate\Database\Seeder;

use App\Subcategoria;
use App\Categoria;

class SubcategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategoria::truncate();

        $faker = \Faker\Factory::create();

        foreach (Categoria::all() as $categoria) {
            for ($i = 0; $i < 3; $i++) {
                Subcategoria::create([
                    'descripcion' => $faker->sentence(),
                    'categoria_id' => $categoria->id
                ]);
            }
        }
    }
}
