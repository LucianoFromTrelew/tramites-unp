<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategoriasTableSeeder::class);
         $this->call(MetodosTableSeeder::class);
         $this->call(TramitesTableSeeder::class);
         $this->call(DocumentosTableSeeder::class);
         $this->call(RequerimientosTableSeeder::class);
         $this->call(EtiquetasTableSeeder::class);
         $this->call(PasosTableSeeder::class);
         $this->call(UsersTableSeeder::class);
    }
}
