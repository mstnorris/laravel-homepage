<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Site::class, function (Faker\Generator $faker) {
    $geopattern = new \RedeyeVentures\GeoPattern\GeoPattern();
    $geopattern->setString('Mastering Markdown');
    return [
        'category_id' => $faker->randomElement(array_merge([factory(App\Category::class)->create()->id], App\Category::lists('id')->all())),
        'title' => $faker->sentence(2),
        'url' => $faker->url,
        'icon_path' => '',
        'color' => $faker->colorName,
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'color' => $faker->colorName,
    ];
});