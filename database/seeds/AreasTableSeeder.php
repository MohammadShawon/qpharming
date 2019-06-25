<?php

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = ['Paharpur', 'Nagessor', 'Chondi', 'Ram SangKarpur', 'Phulbaria'];

        foreach ($areas as $area) { 
            Area::create([
                'name' => $area,
                'slug' => str_slug($area),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
        
    }
}
