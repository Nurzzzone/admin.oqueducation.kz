<?php

use Illuminate\Database\Seeder;
use Database\Seeders\ClientUserTypesTableSeeder;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\RoleTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UsersProfileTableSeeder::class);
        $this->call(TranslationsLanguagesTableSeeder::class);
        $this->call(ClassesTypesTableSeeder::class);
        $this->call(StudentsTypesTableSeeder::class);
        $this->call(ClientUserTypesTableSeeder::class);
    }
}
