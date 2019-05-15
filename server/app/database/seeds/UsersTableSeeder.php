<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make(env('ADMIN_PASSWORD', 'tramitesunp'));

        User::create([
            'name' => 'admin',
            'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
            'password' => $password
        ]);
    }
}
