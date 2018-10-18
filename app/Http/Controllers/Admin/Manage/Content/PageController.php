<?php

namespace App\Http\Controllers\Admin\Manage\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Page;
use \App\Http\Requests\StoreContentPage;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:content_manager');
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

    	$categories = Category::where('type', Category::TYPE_PAGE)->get();
    	
    	// filter category_id and title or content
    	if($category){
			$pages_query = Page::where('category_id', $category)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		} else {
			$pages_query = Page::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		}

		// sorting if column exist
		if( array_search($sort, Page::getFillables()) !== false ){
	   		$pages_query = $pages_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$pages = $pages_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
        $query = $request->fullUrlWithQuery([]);
	
		return view('admin.manage.content.page.index', compact('pages','categories', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::where('type', Category::TYPE_PAGE)->get();

        return view('admin.manage.content.page.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentPage $request)
    {
    	// creating new object for save request
    	$page = new Page();
    	foreach (Page::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$page[$key] = $request[$key];
    		}
    	}
    	$page['user_id'] = \Auth::id();
    	$page->save();

        \App\Http\Controllers\ImageController::save($request['cropped_image'], $page);
    	if($page){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::where('id',$id)->first();

        if($page){
	        return view('admin.manage.content.page.show', compact('page') );
        }else{
        	return redirect('/admin/manage/content/page');
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
    	$categories = Category::where('type', Category::TYPE_PAGE)->get();
        $page = Page::where('id',$id)->first();

        if($page){
	        return view('admin.manage.content.page.create', compact('page','categories') );
        }else{
        	return redirect('/admin/manage/content/page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContentPage $request, $id)
    {
    	$page = Page::where('id',$id)->first();
        if(!$page){
        	return redirect('/admin/manage/content/page');
        }
    	foreach (Page::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$page[$key] = $request[$key];
    		}
    	}
    	$page['user_id'] = \Auth::id();
    	$page->save();

        \App\Http\Controllers\ImageController::save($request['cropped_image'], $page);
        
    	if($page){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $page = Page::where('id',$id)->first();
        if($page)
        {
        	$page->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/content/page');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/content/page');
        }
    }
}
