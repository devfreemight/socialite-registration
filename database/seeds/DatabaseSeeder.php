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
        $this->call([CitySeeder::class, BarangaySeeder::class, UserSeeder::class]);

        if ($this->isLocalEnvironment()) {
            $this->call([RegistrantSeeder::class]);
        }
    }

    protected function isLocalEnvironment() {
        return \Config::get('app.env') == 'local';
    }
}
