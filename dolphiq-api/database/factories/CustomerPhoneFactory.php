<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\CustomerPhone::class, function (Faker $faker) {
    return [
        'phone_number' => $faker->numerify('##########')
    ];
});
