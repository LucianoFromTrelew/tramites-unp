<?php

use Illuminate\Database\Seeder;

use App\Metodo;

class MetodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodos = [
            'Presencial',
            'Online',
            'Por teléfono'
        ];

        foreach ($metodos as $metodo) {
            Metodo::create([
                'descripcion' => $metodo
            ]);
        }
    }
}
