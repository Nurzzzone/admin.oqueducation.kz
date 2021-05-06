<?php

use Illuminate\Database\Seeder;
use Database\Seeders\ClientUserTypesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(UsersProfileTableSeeder::class);
        $this->call(TranslationsLanguagesTableSeeder::class);
        $this->call(ClassesTypesTableSeeder::class);
        $this->call(StudentsTypesTableSeeder::class);
        $this->call(ClientUserTypesTableSeeder::class);
    }
}
