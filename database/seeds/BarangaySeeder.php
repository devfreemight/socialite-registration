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
        $cebuCity = json_decode(file_get_contents(database_path('json\barangays\CebuCity.json')), true);
        foreach ($cebuCity as $value) {
            \App\Barangay::create($value);
        }

        $iloiloCity = json_decode(file_get_contents(database_path('json\barangays\IloiloCity.json')), true);
        foreach ($iloiloCity as $value) {
            \App\Barangay::create($value);
        }

        $ormocCity = json_decode(file_get_contents(database_path('json\barangays\OrmocCity.json')), true);
        foreach ($ormocCity as $value) {
            \App\Barangay::create($value);
        }

        $taclobanCity = json_decode(file_get_contents(database_path('json\barangays\TaclobanCity.json')), true);
        foreach ($taclobanCity as $value) {
            \App\Barangay::create($value);
        }
    }
}
