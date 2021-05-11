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
            [
                'name'       => 'Michael',
                'surname'    => 'Scott',
                'user_id'    => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name'       => 'Jim',
                'surname'    => 'Halpert',
                'user_id'    => '2',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
