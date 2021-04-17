<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_profile')->insert([
            'name' => 'Michael',
            'surname' => 'Scott',
            'user_id' => '1',
        ]);
    }
}
