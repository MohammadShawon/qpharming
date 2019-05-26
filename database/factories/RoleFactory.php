<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
//        Select Random Elements in Faker
        'name' => $faker->randomElement([
            'admin',
            'manager',
            'employee',
            'user'

        ])
    ];
});
