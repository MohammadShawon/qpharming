<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Farmer;

class FarmersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $farmer) {
            Farmer::create([
                'branch_id'      => rand(1, 5),
                'name'           => $faker->name,
                'phone1'         => $faker->phoneNumber,
                'phone2'         => $faker->phoneNumber,
                'address'        => $faker->address,
                'opening_balance'=> rand(500, 1000),
                'starting_date'  => new DateTime,
                'status'         => 'active',
                'created_at'     => new DateTime,
                'updated_at'     => new DateTime,
            ]);
        }
    }
}
