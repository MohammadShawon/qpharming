<?php

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = ['gm','Kg','ml','L','bag'];
        foreach ($units as $unit)
        {
            Unit::create([
               'name' => $unit
            ]);
        }
    }
}
