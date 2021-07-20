<?php

use Faker\Generator as Faker;

$factory->define(\App\Order::class, function (Faker $faker) {
    return [
        'customer_name' => $faker->name,
        'customer_email' => $faker->email,
        'customer_mobile' => '3124444333',
        'status' => $faker->randomElement(['CREATED', 'PAYED', 'REJECTED']),
        'total' => 175000,
        'currency' => config('store.currency')

    ];
});
