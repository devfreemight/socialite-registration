<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Registrant;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Registrant::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'gender' => \Arr::random([0,1]),
        'birthday' => $this->faker->date(),
        'contact_no' => $this->faker->phoneNumber,
        'age' => \Arr::random(range(10, 100)),
        'street' => $this->faker->address,
        'barangay_id' => \Arr::random(range(1, 20)),
        'city_id' => \Arr::random(range(1, 4)),
        'landmark' => \Str::random(10),
    ];
});
