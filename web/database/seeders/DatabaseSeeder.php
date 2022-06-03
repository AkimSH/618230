<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $cuisines = [
            ['cuisine_name' => 'Restaurant'],
            ['cuisine_name' => 'Bar'],
            ['cuisine_name' => 'Pub'],
            ['cuisine_name' => 'Сafeteria'],
            ['cuisine_name' => 'European'],
            ['cuisine_name' => 'Asian'],
            ['cuisine_name' => 'Vietnamese'],
            ['cuisine_name' => 'Indian']
        ];

        $restaurants = [
            ['restaurant_name' => 'Noma Restaurant'],
            ['restaurant_name' => 'Geranium'],
            ['restaurant_name' => 'Asador Etxebarri'],
            ['restaurant_name' => 'Central'],
            ['restaurant_name' => 'Disfrutar'],
            ['restaurant_name' => 'Frantzén'],
            ['restaurant_name' => 'Maido'],
        ];

        foreach ($cuisines as $cuisine){
            Cuisine::create($cuisine);
        }
        foreach ($restaurants as $restaurant){
            Restaurant::create($restaurant);
        }

        $cuisine_list = Cuisine::all();

        Restaurant::all()->each(function ($restaurants_list) use ($cuisine_list) {
            $restaurants_list->cuisines()->attach(
                $cuisine_list->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
