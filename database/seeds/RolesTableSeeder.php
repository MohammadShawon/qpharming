<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        	[
        		'id'   => 1,
        		'name' => 'superadmin'
        	],
        	[
        		'id'   => 2,
        		'name' => 'admin'
        	],
        	[
        		'id'   => 3,
        		'name' => 'manager'
        	],
        	[
        		'id'   => 4,
        		'name' => 'employee'
        	],
        	[
        		'id'   => 5,
        		'name' => 'user'
        	],
        ];

        foreach ($roles as $role) {
		        Role::create($role);
		    }
    }
}
