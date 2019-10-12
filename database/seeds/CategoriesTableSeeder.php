<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Chicks', 'Feeds', 'Medicines'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => str_slug($category),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ]);
        }
    }
}
