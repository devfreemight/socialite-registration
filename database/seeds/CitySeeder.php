<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            "city_id"       => "072217",
            "name"          => "Cebu City",
            "region_code"   => "07",
            "province_code" => "0722",
        ]);
    }
}
