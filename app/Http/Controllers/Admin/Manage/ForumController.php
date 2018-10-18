<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Forum;
use \App\Http\Requests\StoreForum;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:forum_manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	// for sort or filter
    	$sort = $request['sort'];
		$name = $request['name'];
    	$order = $request['order'];
        $category = $request['category'];
        $status = $request['status'];
		$role = $request['role'];

    	$categories = Category::where('type', Category::TYPE_FORUM)->get();
    	
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
        $forums_query = $forums_query->where('status', 'like', '%'.$status.'%')
            ->withCount('views');

        $forums_query = $forums_query->checkUserRole($role);
		// sorting if column exist
		if( array_search($sort, Forum::getFillables()) !== false ){
	   		$forums_query = $forums_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$forums = $forums_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
	   
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.forum.index', compact('forums','categories','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::where('type', Category::TYPE_FORUM)->get();
    	$question_forums = Forum::where('forum_id',null)->get();

        return view('admin.manage.forum.create', compact('categories','question_forums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreForum $request)
    {
    	// creating new object for save request
    	$forum = new Forum();
    	foreach (Forum::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$forum[$key] = $request[$key];
    		}
    	}
    	$forum['user_id'] = \Auth::id();
    	$forum->save();

    	if($forum){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/forum');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum = Forum::where('id',$id)->first();
        if($forum){
            if($forum->admin_seen === 0)
            {
                $forum->admin_seen = 1;
                $forum->save();
            }
	        return view('admin.manage.forum.show', compact('forum') );
        }else{
        	return redirect('/admin/manage/forum');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$categories = Category::where('type', Category::TYPE_FORUM)->get();
        $forum = Forum::where('id',$id)->first();
    	$question_forums = Forum::where('forum_id',null)->get();

        if($forum){
	        return view('admin.manage.forum.create', compact('forum','categories','question_forums') );
        }else{
        	return redirect('/admin/manage/forum');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreForum $request, $id)
    {
    	$forum = Forum::where('id',$id)->first();
        if(!$forum){
        	return redirect('/admin/manage/forum');
        }
    	foreach (Forum::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$forum[$key] = $request[$key];
    		}
    	}
    	$forum['user_id'] = \Auth::id();
    	$forum->save();

    	if($forum){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $forum = Forum::where('id',$id)->first();
        if($forum)
        {
        	$forum->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/forum');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/forum');
        }
    }
}
