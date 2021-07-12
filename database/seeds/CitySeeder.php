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
            "city_id"       => "083738",
            "name"          => "Ormoc City",
            "region_code"   => "08",
            "province_code" => "0837",
        ]);

        City::create([
            "city_id"       => "083747",
            "name"          => "Tacloban City",
            "region_code"   => "08",
            "province_code" => "0837",
        ]);

        City::create([
            "city_id"        => "063022",
            "name"          => "Ilo-ilo City",
            "region_code"   => "06",
            "province_code" => "0630",
        ]);
    }
}
