<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'      => $faker->name,
        'branch_id' => rand(1, 5),
        'username'  => $faker->userName,
        'email'     => $faker->unique()->safeEmail,
//        'email_verified_at' => now(),
        'password'  => bcrypt('12345678'), // password
        'phone1'    => $faker->phoneNumber,
        'phone2'    => $faker->phoneNumber,
        'address'   => $faker->address,
        'status'    => 'active',
        'remember_token' => Str::random(10),
    ];
});
