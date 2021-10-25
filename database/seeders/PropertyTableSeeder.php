<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
 
        for ($i = 0; $i < 15; $i++) {
            Property::create([
                'name' => $faker->address,
            ]);
        }
    }
}
