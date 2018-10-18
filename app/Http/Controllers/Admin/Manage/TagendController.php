<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Tagend;
use \App\Http\Requests\StoreTagend;
use \App\Http\Controllers\ImageController;

class TagendController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:product_manager');
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
    	
    	// filter title or content
		$tagends_query = Tagend::where('is_copon', 0)
            ->where(function($query) use ($name){
		        $query->where('title', 'like', '%'.$name.'%');
		        $query->orWhere('description', 'like', '%'.$name.'%');
		    });

		// sorting if column exist
		if( array_search($sort, Tagend::getFillables()) !== false ){
	   		$tagends_query = $tagends_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$tagends = $tagends_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name,]);   
	   
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.tagend.index', compact('tagends','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.tagend.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagend $request)
    {
        $tagend = $request->all();
        $tagend['user_id'] = \Auth::id();
        $tagend = Tagend::create($tagend);

    	if($tagend){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/tagend');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tagend = Tagend::where('is_copon', 0)
            ->where('id',$id)
            ->first();

        if($tagend){
	        return view('admin.manage.tagend.show', compact('tagend') );
        }else{
        	return redirect('/admin/manage/tagend');
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
        $tagend = Tagend::where('is_copon', 0)
            ->where('id',$id)
            ->first();

        if($tagend){
	        return view('admin.manage.tagend.create', compact('tagend') );
        }else{
        	return redirect('/admin/manage/tagend');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTagend $request, $id)
    {
    	$tagend = Tagend::where('is_copon', 0)
            ->where('id',$id)->first();
        if(!$tagend){
        	return redirect('/admin/manage/tagend');
        }
    	foreach (Tagend::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$tagend[$key] = $request[$key];
    		}
    	}
    	$tagend['user_id'] = \Auth::id();
    	$tagend->save();

    	\App\Http\Controllers\ImageController::save($request['cropped_image'], $tagend);
    	if($tagend){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/tagend');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $tagend = Tagend::where('id',$id)->first();
        if($tagend)
        {
        	$tagend->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/tagend');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/tagend');
        }
    }
}
