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

        City::create([
            "city_id"       => "072226",
            "name"          => "Lapu-lapu City",
            "region_code"   => "07",
            "province_code" => "0722",
        ]);

        City::create([
            "city_id"       => "072230",
            "name"          => "Mandaue City",
            "region_code"   => "07",
            "province_code" => "0722",
        ]);

        City::create([
            "city_id"       => "072250",
            "name"          => "Talisay City",
            "region_code"   => "07",
            "province_code" => "0722",
        ]);
    }
}
