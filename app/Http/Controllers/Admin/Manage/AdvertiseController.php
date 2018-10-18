<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Advertise;
use \App\Http\Requests\StoreAdvertise;

class AdvertiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:advertise_manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$sort = $request['sort'];
        $order = $request['order'];
		$name = $request['name'];
		$category = $request['category'];
        $status = $request['status'];
        $role = $request['role'];

    	$categories = Category::where('type', Category::TYPE_ADVERTISE)->get();
    	
    	if($category){
			$advertises_query = Advertise::where('category_id', $category)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('description', 'like', '%'.$name.'%');
			    });
		} else {
			$advertises_query = Advertise::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('description', 'like', '%'.$name.'%');
			    });
		}
        $advertises_query = $advertises_query->where('status', 'like', '%'.$status.'%')
            ->withCount('views');

        $advertises_query = $advertises_query->checkUserRole($role);

		if( array_search($sort, Advertise::getFillables()) !== false ){
	   		$advertises_query = $advertises_query->orderBy($sort, $order);
	   	}

	   	$advertises = $advertises_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category, 'status' => $status]);   
        $query = $request->fullUrlWithQuery([]);

		return view('admin.manage.advertise.index', compact('advertises','categories','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::where('type', Category::TYPE_ADVERTISE)->get();

        return view('admin.manage.advertise.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertise $request)
    {
    	$group_id = rand(1000,9999);
        foreach($request['price'] as $key_array => $item)
        {
            $advertise = new Advertise();
            foreach (Advertise::getFillables() as $key) {
                if( isset($request[$key]) ){
                    if(array_search($key, Advertise::getFillableArrays()) !== false )
                    {
                        $advertise[$key] = isset($request[$key][$key_array]) ? $request[$key][$key_array] : null;
                    }else{
                        $advertise[$key] = $request[$key];
                    }
                }
            }

            if($advertise['price_type'] == 'توافقی')
            {
                $advertise['price'] = 0;
            }
            $advertise['group_id'] = $group_id;
            $advertise['user_id'] = \Auth::id();
            $advertise->save();

            foreach($request->all() as $key => $value)
            {
                if (strpos($key, 'gallery') !== false) {
                    $advertise->images()->syncWithoutDetaching([$value]);
                }
            }
        }

    	if($advertise){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/advertise');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advertise = Advertise::where('id',$id)->first();
        if($advertise){
            if($advertise->admin_seen === 0)
            {
                $advertise->admin_seen = 1;
                $advertise->save();
            }
	        return view('admin.manage.advertise.show', compact('advertise') );
        }else{
        	return redirect('/admin/manage/advertise');
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
    	$categories = Category::where('type', Category::TYPE_ADVERTISE)->get();
        $advertise = Advertise::where('id',$id)->first();

        if($advertise){
	        return view('admin.manage.advertise.create', compact('advertise','categories') );
        }else{
        	return redirect('/admin/manage/advertise');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdvertise $request, $id)
    {
    	$advertise = Advertise::where('id',$id)->first();
        if(!$advertise){
        	return redirect('/admin/manage/advertise');
        }
    	foreach (Advertise::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$advertise[$key] = $request[$key];
    		}
    	}
    	$advertise['user_id'] = \Auth::id();
    	$advertise->save();

        // save advertise image gallery
        foreach($request->all() as $key => $value)
        {
            if (strpos($key, 'gallery') !== false) {
                $advertise->images()->syncWithoutDetaching([$value]);
            }
        }

    	if($advertise){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/advertise');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $advertise = Advertise::where('id',$id)->first();
        if($advertise)
        {
        	$advertise->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/advertise');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/advertise');
        }
    }
}
