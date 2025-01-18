<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\meeting;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MeetingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 5; $i++) {

            DB::table('meetings')->insert([
                'name' => $faker->name,
                'description' => $faker->text,
                'place' => $faker->numberBetween(0,150),
            ]);
        }
    }
}
