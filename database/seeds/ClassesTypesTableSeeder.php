<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes_types')->insert([
            [
                'name'       => 'БИЛ',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ],
            [
                'name'       => 'НИШ',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ],
            [
                'name'       => 'ЕНТ',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]
        ]);
    }
}
