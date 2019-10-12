<?php

use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = ['broylar', 'Layer', 'Renamysin','Eramin','Vutta','Gom'];

        foreach ($subcategories as $subcategory) { 
            SubCategory::create([
                'category_id' => rand(1, 3),
                'name' => $subcategory,
                'slug' => str_slug($subcategory),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
    }
}
