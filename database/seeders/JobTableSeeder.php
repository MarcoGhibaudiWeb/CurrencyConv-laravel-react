<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $input = array("open", "in progress", "completed", "cancelled");

        for ($i = 0; $i < 10; $i++) {
        $status = array_rand($input, 1);
            Job::create([
                'summary' => $faker->text(150),
                'description' => $faker->text(500),
                'status' => $input[$status],
                'property'=> rand(1, 15),
                'fname' => $faker->firstName(),
                'lname' => $faker->lastName()
            ]);
        }
    }
}
