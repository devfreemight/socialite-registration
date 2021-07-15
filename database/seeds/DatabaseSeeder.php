<?php

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
        if ($this->isLocalEnvironment()) {
            $this->call([RegistrantSeeder::class, UserSeeder::class]);
        }

        $this->call([CitySeeder::class, BarangaySeeder::class]);
    }

    protected function isLocalEnvironment() {
        return \Config::get('app.env') == 'local';
    }
}
