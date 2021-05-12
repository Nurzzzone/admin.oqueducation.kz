<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * List of cities
     * 
     * @var array
     */
    protected $cities = [
        ['name' => 'Алматы'],
        ['name' => 'Нур-Султан(Астана)'],
        ['name' => 'Шымкент(Чимкент)'],
        ['name' => 'Актобе(Актюбинск)'],
        ['name' => 'Караганда'],
        ['name' => 'Тараз(Жамбыл)'],
        ['name' => 'Павлодар'],
        ['name' => 'Усть-Каменогорск'],
        ['name' => 'Семей(Семипалатинск)'],
        ['name' => 'Атырау'],
        ['name' => 'Костанай(Кустанай)'],
        ['name' => 'Кызылорда(Кызыл-Орда)'],
        ['name' => 'Уральск'],
        ['name' => 'Петропавловск'],
        ['name' => 'Актау'],
        ['name' => 'Темиртау'],
        ['name' => 'Туркестан'],
        ['name' => 'Кокшетау(Кокчетав)'],
        ['name' => 'Талдыкорган'],
        ['name' => 'Экибастуз'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            foreach ($this->cities as $city) {
                City::create($city);
            }            
        });
    }
}
