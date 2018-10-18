<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Forum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function index(Request $request)
    {
    	// for sort or filter
    	$sort = $request['sort'];
		$name = $request['name'];
    	$order = $request['order'];
		$category = $request['category'];

    	$categories = Category::where('type', Category::TYPE_FORUM)->Active()->get();
    	
    	// filter category_id and title or content
    	if($category){
			$forums_query = Forum::where('category_id', $category)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		} else {
			$forums_query = Forum::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		}
		$forums_query = $forums_query->where('forum_id', null);
		// sorting if column exist
		if( array_search($sort, Forum::getFillables()) !== false ){
	   		$forums_query = $forums_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$forums = $forums_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
	
		return view('user.forum.index', compact('forums','categories'));
    }

    public function show($id)
    {
    	$forum = Forum::where('id',$id)->first();
        \App\Models\ForumView::create(['forum_id' => $forum->id]);

    	return view('user.forum.show',compact('forum') );
    }
}
