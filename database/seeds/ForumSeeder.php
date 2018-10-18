<?php

use Illuminate\Database\Seeder;
use \App\Models\Forum;
use \App\Models\Category;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $forums = [
     //    	[
     //    		'title' => 'پوست من دچار خشکی میشود در فصل زمستان.',
	    // 		'content' => 'پوست من دچار خشکی میشود در فصل زمستان. راه حل شما برای این مشکل من چیست ؟',
	    // 		'status' => Forum::STATUS_ACTIVE,
	    // 		'forum_id' => null,
	    // 		'user_id' => 2,
	    // 	],
	    // 	[
     //    		'title' => 'از کرم مربوطه استفاده نمایید',
	    // 		'content' => 'پوست شما به دلیل وجود حساسیت و عدم داشتن وییتامین های لازم دچار خشکی میشود و برای بازسازی آن نیاز به ویتامین آ دارد که در هویج موجود است.',
	    // 		'status' => Forum::STATUS_ACTIVE,
	    // 		'forum_id' => 1,
	    // 		'user_id' => 2,
	    // 	],
     //    ];
     //    $category = Category::where('type',Category::TYPE_FORUM)->first();
     //    foreach($forums as $forum)
     //    {
     //    	$forum['category_id'] = isset($category) ? $category->id : null;
     //    	$forum['user_id'] = 2;
	    //     Forum::firstOrCreate($forum);
     //    }
    }
}
