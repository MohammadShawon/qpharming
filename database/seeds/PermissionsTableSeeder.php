<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
        	['name' => 'view_area'], 		['name' => 'create_area'],
        	['name' => 'edit_area'], 		['name' => 'delete_area'],
        	['name' => 'view_branch'], 		['name' => 'create_branch'],
        	['name' => 'edit_branch'], 		['name' => 'delete_branch'],
        	['name' => 'view_category'], 	['name' => 'create_category'],
        	['name' => 'edit_category'], 	['name' => 'delete_category'],
        	['name' => 'view_sub-category'],['name' => 'create_sub-category'],
        	['name' => 'edit_sub-category'],['name' => 'delete_sub-category'],
        	['name' => 'view_company'], 	['name' => 'create_company'],
        	['name' => 'edit_company'], 	['name' => 'delete_company'],
        	['name' => 'view_farmer'], 		['name' => 'create_farmer'],
			['name' => 'edit_farmer'], 		['name' => 'delete_farmer'],
			['name' => 'view_user'], 		['name' => 'create_user'],
			['name' => 'edit_user'], 		['name' => 'delete_user'],
			['name' => 'view_product'], 	['name' => 'create_product'],
			['name' => 'edit_product'], 	['name' => 'delete_product'],
			['name' => 'view_product-price'], 	['name' => 'create_product-price'],
			['name' => 'edit_product-price'], 	['name' => 'delete_product-price'],
			['name' => 'view_unit'], 		['name' => 'create_unit'],
			['name' => 'edit_unit'], 		['name' => 'delete_unit'],
			['name' => 'view_unit-convert'],['name' => 'create_unit-convert'],
        	['name' => 'edit_unit-convert'],['name' => 'delete_unit-convert'],
            ['name' => 'view_customer'], ['name' => 'create_customer'],
            ['name' => 'edit_customer'], ['name' => 'delete_customer'],
        ];

        foreach ($permissions as $permission) {
		        Permission::create($permission);
		    }
    }
}
