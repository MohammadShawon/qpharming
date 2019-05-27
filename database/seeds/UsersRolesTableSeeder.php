<?php

use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users_roles = [
    		[
    			'user_id' => 1,
    		    'role_id' => 1
    		],
    		[
    			'user_id' => 2,
    		    'role_id' => 2
    		],
    		[
    			'user_id' => 3,
    		    'role_id' => 3
    		],
    		[
    			'user_id' => 4,
    		    'role_id' => 4
    		],
    		[
    			'user_id' => 5,
    		    'role_id' => 5
    		],
    	];

    	foreach ($users_roles as $users_role) {
    		DB::table('users_roles')->insert($users_role);
    	}
        
    }
}
