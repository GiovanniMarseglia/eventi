<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\event;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 5; $i++) {

            $start = $faker->dateTimeBetween('now', '+2 week');


            $end = $faker->dateTimeBetween($start, '+2 week');

            DB::table('events')->insert([
                'title' => $faker->sentence(3),
                'description' => $faker->text,
                'start' => $start,
                'end' => $end,
                'image' => NULL,
                'color' => $faker->hexColor,
                'meeting_id' => $i+1,
            ]);
        }
    }
}
