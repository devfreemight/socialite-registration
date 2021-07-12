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
            $this->call(RegistrantSeeder::class);
        }

        $this->call(CitySeeder::class);
    }

    protected function isLocalEnvironment() {
        return \Config::get('app.env') == 'local';
    }
}
