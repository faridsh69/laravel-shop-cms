<?php

namespace App\Http\Controllers\Admin\Manage\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\News;
use \App\Http\Requests\StoreContentNews;

class NewsController extends Controller
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

    	$categories = Category::where('type', Category::TYPE_NEWS)->get();
    	
    	// filter category_id and title or content
    	if($category){
			$newses_query = News::where('category_id', $category)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		} else {
			$newses_query = News::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		}

		// sorting if column exist
		if( array_search($sort, News::getFillables()) !== false ){
	   		$newses_query = $newses_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$newses = $newses_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
	    $query = $request->fullUrlWithQuery([]);
        
		return view('admin.manage.content.news.index', compact('newses','categories', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::where('type', Category::TYPE_NEWS)->get();

        return view('admin.manage.content.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentNews $request)
    {
    	// creating new object for save request
    	$news = new News();
    	foreach (News::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$news[$key] = $request[$key];
    		}
    	}
    	$news['user_id'] = \Auth::id();
    	$news->save();

    	\App\Http\Controllers\ImageController::save($request['cropped_image'], $news);

    	if($news){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::where('id',$id)->first();

        if($news){
	        return view('admin.manage.content.news.show', compact('news') );
        }else{
        	return redirect('/admin/manage/content/news');
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
    	$categories = Category::where('type', Category::TYPE_NEWS)->get();
        $news = News::where('id',$id)->first();

        if($news){
	        return view('admin.manage.content.news.create', compact('news','categories') );
        }else{
        	return redirect('/admin/manage/content/news');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContentNews $request, $id)
    {
    	$news = News::where('id',$id)->first();
        if(!$news){
        	return redirect('/admin/manage/content/news');
        }
    	foreach (News::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$news[$key] = $request[$key];
    		}
    	}
    	$news['user_id'] = \Auth::id();
    	$news->save();

    	\App\Http\Controllers\ImageController::save($request['cropped_image'], $news);
        
    	if($news){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $news = News::where('id',$id)->first();
        if($news)
        {
        	$news->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/content/news');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/content/news');
        }
    }
}
