<?php

use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =[ 
        	[
        		'id' => 1,
	        	'first_name' => 'فرید',
	    		'last_name' => 'شهیدی',
	    		'phone' => '1',
	    		'password' => bcrypt(1),
	    		'email' => 'farid.sh69@gmail.com',
	    		'national_code' => '1270739034',
	    		'gender' => 'male',
	    		'birthday' => '1990-01-10',
	    		'used_marketer_code' => '1-far',
	    		'generated_marketer_code' => '1-far',
	    		'rate' => 5,
	    		'credit' => 10000,
	    		'status' => User::STATUS_ACTIVE,
	    		'image_id' => 1,
	    	],
            ['id' => 2, 'first_name' => 'مدیر', 'last_name' => 'سایت', 'phone' => '2', 'password' => bcrypt(2)],
        ];
        
        foreach($users as $user)
        {
            $user = User::updateOrCreate(['id' => $user['id'] ] , $user);
            if($user->id == 1 ){ 
                $user->roles()->sync([4,14], false);
            }elseif($user->id == 2 ){
                $user->roles()->sync([4,14], false);
            }
        }
    }
}
