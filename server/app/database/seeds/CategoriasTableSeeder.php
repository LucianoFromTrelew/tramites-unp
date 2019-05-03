<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'Personal',
            'Sismo y/o situación de emergencia',
            'Escuelas',
            'Identidad',
            'Seguridad Social y retiro/Apoyos sociales',
            'Sociales',
            'Empleo',
            'Impuestos',
            'Migración, visa y pasaporte',
            'Finanzas',
            'Territorio',
            'Servicios turismo',
            'Ambiente',
            'Seguridad',
            'Financieros',
            'Transportes',
            'Servicios eléctricos',
            'Asociaciones y organizaciones',
            'Denuncias, quejas e inconformidades',
            'Zonas económicas especiales',
            'Lo más buscado',
            'Identidad, pasaporte y migración',
            'Educación',
            'Salud',
            'Trabajo',
            'Impuestos y contribuciones',
            'Seguridad, legalidad y justicia',
            'Programas sociales',
            'Economía',
            'Territorio y vivienda',
            'Medio ambiente',
            'Comunicaciones y transportes',
            'Energía',
            'Servicios financieros',
            'Turismo',
            'Otros '
        ];
        foreach ($categorias as $categoria) {
            Categoria::create([
                'descripcion' => $categoria
            ]);
        }
    }
}
