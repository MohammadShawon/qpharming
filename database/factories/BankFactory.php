<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Bank;
use Faker\Generator as Faker;

$factory->define(Bank::class, function (Faker $faker) {
    return [
        'bank_name'         => 'UCB',
        'account_name'      => 'Cash',
        'account_number'    => '0000',
        'opening_balance'   => 0,
    ];
});
