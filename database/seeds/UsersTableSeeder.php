<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		    $users = [            
		        [
		        	'id' 		=> 1, 
		        	'name'      => 'Mr. Super Admin',
			        'branch_id' => rand(1, 5),
			        'username'  => 'superadmin',
			        'email'     => 'superadmin@qfarming@com',
			//        'email_verified_at' => now(),
			        'password'  => bcrypt('12345678'), // password
			        'phone1'    => '0123456789',
			        'phone2'    => '9876543210',
			        'address'   => 'Mymensign, Dhaka',
			        'status'    => 'active',
			        'remember_token' => Str::random(10),
		        ],
		        [
		        	'id' 		=> 2, 
		        	'name'      => 'Mr. Admin',
			        'branch_id' => rand(1, 5),
			        'username'  => 'admin',
			        'email'     => 'admin@qfarming@com',
			//        'email_verified_at' => now(),
			        'password'  => bcrypt('12345678'), // password
			        'phone1'    => '0123456789',
			        'phone2'    => '9876543210',
			        'address'   => 'Mymensign, Dhaka',
			        'status'    => 'active',
			        'remember_token' => Str::random(10),
		        ],
		        [
		        	'id' 		=> 3, 
		        	'name'      => 'Mr. Manager',
			        'branch_id' => rand(1, 5),
			        'username'  => 'manager',
			        'email'     => 'manager@qfarming@com',
			//        'email_verified_at' => now(),
			        'password'  => bcrypt('12345678'), // password
			        'phone1'    => '0123456789',
			        'phone2'    => '9876543210',
			        'address'   => 'Mymensign, Dhaka',
			        'status'    => 'active',
			        'remember_token' => Str::random(10),
		        ],
		        [
		        	'id' 		=> 4, 
		        	'name'      => 'Mr. Employee',
			        'branch_id' => rand(1, 5),
			        'username'  => 'employee',
			        'email'     => 'emoployee@qfarming@com',
			//        'email_verified_at' => now(),
			        'password'  => bcrypt('12345678'), // password
			        'phone1'    => '0123456789',
			        'phone2'    => '9876543210',
			        'address'   => 'Mymensign, Dhaka',
			        'status'    => 'active',
			        'remember_token' => Str::random(10),
		        ],
		        [
		        	'id' 		=> 5, 
		        	'name'      => 'Mr. User',
			        'branch_id' => rand(1, 5),
			        'username'  => 'user',
			        'email'     => 'user@qfarming@com',
			//        'email_verified_at' => now(),
			        'password'  => bcrypt('12345678'), // password
			        'phone1'    => '0123456789',
			        'phone2'    => '9876543210',
			        'address'   => 'Mymensign, Dhaka',
			        'status'    => 'active',
			        'remember_token' => Str::random(10),
		        ],
		    ];

		    foreach ($users as $user) {
		        User::create($user);
		    }
    }
}
