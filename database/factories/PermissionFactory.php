<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        /*
         * Geenrate Random Permission name
         * */

        'name'  => $faker->randomElement([
            'view',
            'edit',
            'delete',
            'show',
        ]),
    ];
});
