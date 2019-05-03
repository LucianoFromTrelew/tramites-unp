<?php

use Illuminate\Database\Seeder;
use App\Tramite;
use App\Subcategoria;

class TramitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $titulos = [
            'Reincorporación',
            'Inscripción a cursada',
            'Inscripción a mesa de final regular',
            'Inscripción a mesa de final libre',
            'Darse de baja de cursada',
            'Darse de baja de final regular',
            'Darse de baja de final libre',
            'Solicitar certificado de alumno regular',
            'Solicitar certificado de título en trámite',
            'Solicitar certificado analítico parcial',
            'Cancelar solicitud de certificado de alumno regular',
            'Cancelar solicitud de certificado de título en trámite',
            'Cancelar solicitud de certificado analítico parcial',
            'Consultar historia académica',
            'Consultar actuación provisoria',
            'Consultar actuación provisoria de cursadas',
            'Consultar regularidades',
        ];

        foreach ($titulos as $titulo) {
            $tramite = new Tramite();
            $tramite->titulo = $titulo;
            $tramite->descripcion = $faker->sentence;
            $tramite->subcategoria_id = random_int(
                Subcategoria::first()->id,
                Subcategoria::count(),
            );
            $tramite->save();
        }
    }
}
