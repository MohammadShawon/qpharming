<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Customer;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name'      => $faker->name,
        'phone'     => $faker->phoneNumber,
        'address'   => $faker->address,
        'created_at' => Carbon::now('+6.30'),
        'updated_at' => Carbon::now('+6.30'),
    ];
});
