<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Brand;
use \App\Http\Requests\StoreBrand;
use \App\Http\Controllers\ImageController;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:product_manager');
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
		$brands_query = brand::where(function($query) use ($name){
		        $query->where('title', 'like', '%'.$name.'%');
		        $query->orWhere('description', 'like', '%'.$name.'%');
		    });

		// sorting if column exist
		if( array_search($sort, Brand::getFillables()) !== false ){
	   		$brands_query = $brands_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$brands = $brands_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name,]);   
	   
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.brand.index', compact('brands','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrand $request)
    {
        $brand = $request->all();
        $brand['user_id'] = \Auth::id();
        $brand = Brand::create($brand);
        \App\Http\Controllers\ImageController::save($request['cropped_image'], $brand);

    	if($brand){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::where('id',$id)->first();

        if($brand){
	        return view('admin.manage.brand.show', compact('brand') );
        }else{
        	return redirect('/admin/manage/brand');
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
        $brand = Brand::where('id',$id)->first();

        if($brand){
	        return view('admin.manage.brand.create', compact('brand') );
        }else{
        	return redirect('/admin/manage/brand');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrand $request, $id)
    {
    	$brand = Brand::where('id',$id)->first();
        if(!$brand){
        	return redirect('/admin/manage/brand');
        }
    	foreach (Brand::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$brand[$key] = $request[$key];
    		}
    	}
    	$brand['user_id'] = \Auth::id();
    	$brand->save();

    	\App\Http\Controllers\ImageController::save($request['cropped_image'], $brand);
    	if($brand){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $brand = Brand::where('id',$id)->first();
        if($brand)
        {
        	$brand->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/brand');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/brand');
        }
    }
}
