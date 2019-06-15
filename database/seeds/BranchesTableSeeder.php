<?php


use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = ['branch 1', 'branch 2', 'branch 3','branch 4','branch 5'];

        foreach ($branches as $branch) { 
            Branch::create([
                'area_id' => rand(1, 5),
                'name' => $branch,
                'slug' => str_slug($branch),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
    }
}
