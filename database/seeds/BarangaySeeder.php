<?php

use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cebuCity = json_decode(file_get_contents(database_path('json/barangays/CebuCity.json')), true);
        foreach ($cebuCity as $value) {
            \App\Barangay::create($value);
        }
    }
}
