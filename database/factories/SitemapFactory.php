<?php

use Curlychoi\LaravelSitemap\Models\Sitemap;

$factory->define(Sitemap::class, function (Faker\Generator $faker) {
    return [
        'loc' => $faker->unique()->url,
        'changefreq' => $faker->randomElement([
            'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never',
        ]),
        'priority' => $faker->randomFloat(1, 0.1, 0.9),
    ];
});

