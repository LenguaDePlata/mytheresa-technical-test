<?php

use Faker\Generator as Faker;
use App\Models\Item;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'price' => $faker->randomFloat(2, 0, 999999.99)
    ];
});
