<?php

use Illuminate\Database\Seeder;

class RegistrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Registrant::class, 50)->create();
    }
}
