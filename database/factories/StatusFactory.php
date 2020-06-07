<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    $date_time=$faker->date.' '.$faker->time;
    // $user_ids=['1','2','3'];

    return [
        'content' => $faker->text(),
        // 'user_id' => $faker->randomElement($user_ids),
        // 'user_id' => factory(App\Models\User::class),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
