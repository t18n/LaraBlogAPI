<?php

use Carbon\Carbon;

// $factory->define(App\Models\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->email,
//     ];
// });

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
    'title' => $faker->sentence(6, true),
    'content' => $faker->paragraphs(3, true),
    'status' => $faker->numberBetween(1,3),
    'slug' => $faker->slug,
    'seed' => $faker->randomDigit,
    'rating' => $faker->randomFloat(NULL, 1, 5),
    'category_id' => $faker->numberBetween(1,10),
    'view_count' => $faker->numberBetween(1,10),
    'user_id' => $faker->numberBetween(1,20),
    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
    'name' => $faker->username,
    'email' => $faker->email,
    'password' => $faker->password,
    'avatar' => $faker->imageUrl(70, 70, 'people'),
    'cover' => $faker->imageUrl(640, 480, 'people'),
    'birthday' => $faker->dateTimeBetween($startDate = '-90 years', $endDate = '-18 years'),
    'nickname' => $faker->name,
    'occupation' => $faker->jobTitle,
    'address' => $faker->address,
    'role_id' => $faker->numberBetween(1,4),
    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});


$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
    'name' => $faker->word,
    'slug' => $faker->slug
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
    'name' => $faker->word,
    'slug' => $faker->slug
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
    'name' => $faker->jobTitle,
    'slug' => $faker->slug
    ];
});