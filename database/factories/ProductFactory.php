<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'price'       => $faker->numberBetween(10000, 60000),
        'category_id' => function () {
            return \App\Category::all()->random();
        },
        'created_by' => function () {
            return \App\User::all()->random();
        }
    ];
});
