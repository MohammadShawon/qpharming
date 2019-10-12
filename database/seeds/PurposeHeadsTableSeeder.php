<?php

use App\Models\PurposeHead;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PurposeHeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purposes = [
            [
                'id'            => 1,
                'name'          =>  'Advance Payment',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 2,
                'name'          =>  'Workers Bill',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 3,
                'name'          =>  'Employee Cost',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 4,
                'name'          =>  'Farmer Payment',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 5,
                'name'          =>  'Office Maintenance',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id'            => 6,
                'name'          =>  'Others',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        foreach ($purposes as $purpose)
        {
            PurposeHead::create($purpose);
        }
    }
}
