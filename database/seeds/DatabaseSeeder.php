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
        $this->call(CitySeeder::class);

        if ($this->isLocalEnvironment()) {
            $this->call([BarangaySeeder::class, RegistrantSeeder::class, UserSeeder::class]);
        }
    }

    protected function isLocalEnvironment() {
        return \Config::get('app.env') == 'local';
    }
}
