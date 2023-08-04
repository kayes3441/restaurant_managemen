<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        /*
        * if you use factory like below
        * then use ...
        * php artisan db:seed --class=UserSeeder
        */

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'mail' => 'test@example.com',
        // ]);


        /*
         *  calling the admin
         *  /* @Another one
         *  if you call Seeder then like below
         *  then run this command
         *  php artisan db:seed
         *
         */

        $this->call(AdminSeeder::class);
    }
}
