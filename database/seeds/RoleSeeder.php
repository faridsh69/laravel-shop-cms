<?php

use Illuminate\Database\Seeder;
use \App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'agent', 'description' => 'نمایندگی'], 
            ['id' => 2, 'name' => 'coworker', 'description' => 'همکار'],
        	['id' => 3, 'name' => 'marketer', 'description' => 'بازاریاب'],
        	['id' => 4, 'name' => 'general_manager', 'description' => 'مدیر کل'],
        	['id' => 5, 'name' => 'content_manager', 'description' => 'مدیر محتوا'],
        	['id' => 6, 'name' => 'product_manager', 'description' => 'مدیر محصولات'],
        	['id' => 7, 'name' => 'factor_manager', 'description' => 'مدیر سفارشات'],
        	['id' => 8, 'name' => 'advertise_manager', 'description' => 'مدیر آگهی'],
        	['id' => 9, 'name' => 'forum_manager', 'description' => 'مدیر تعمیرات'],
        	['id' => 10, 'name' => 'user_manager', 'description' => 'مدیر کاربران'],
        	['id' => 11, 'name' => 'payment_manager', 'description' => 'مدیر پرداختها'],
        	['id' => 12, 'name' => 'category_manager', 'description' => 'مدیر دسته بندی ها'],
        	['id' => 13, 'name' => 'comment_manager', 'description' => 'مدیر نظرات'],
        	['id' => 14, 'name' => 'developer', 'description' => 'برنامه نویس'],
    	];
        foreach($roles as $role)
        {
            if($role['id'] == 4){
                $role['permissions'] = json_encode([1,2,3,4,5,6,7,8,9,10,11,12,13,14]);
            }
            else if($role['id'] < 15){
                $role['permissions'] = json_encode([ $role['id'] ]);
            }else{
                 $role['permissions'] = null;
            }
    	   	Role::updateOrCreate(['id' => $role['id']],$role); 
        }
    }
}
