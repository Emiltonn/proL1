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
        $this->call(UserTableSeeder::class);
        /*
        teste manual de seeder
        App\User::create([
            'name' => 'Carlos Ferreira',
            'email' => 'carlos@email.com',
            'password' => bcrypt('123456')
        ]);
        */


    }
}
