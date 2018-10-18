<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Feature;
use \App\Http\Requests\StoreFeature;

class FeatureController extends Controller
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
		$category = $request['category'];

    	$categories = Category::where('type', Category::TYPE_PRODUCT)->Active()->get();
    	
    	// filter category_id and title or content
    	if($category){
			$features_query = Feature::where('category_id', $category)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			    });
		} else {
			$features_query = Feature::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			    });
		}

		// sorting if column exist
		if( array_search($sort, Feature::getFillables()) !== false ){
	   		$features_query = $features_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$features = $features_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
	    
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.feature.index', compact('features','categories','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::where('type', Category::TYPE_PRODUCT)->get();

        return view('admin.manage.feature.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeature $request)
    {
    	// creating new object for save request
    	$feature = new Feature();
    	foreach (Feature::getFillables() as $key) {
    		if( isset($request[$key]) ){
                if($key == 'options'){
                    $options = $request['options'];
                    $array = explode("+", $options);
                    $feature['options'] = json_encode($array);
                }else{
                    $feature[$key] = $request[$key];
                }
    		}
    	}
    	$feature['user_id'] = \Auth::id();
    	$feature->save();
       
    	if($feature){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/feature');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feature = Feature::where('id',$id)->first();

        if($feature){
	        return view('admin.manage.feature.show', compact('feature') );
        }else{
        	return redirect('/admin/manage/feature');
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
    	$categories = Category::where('type', Category::TYPE_PRODUCT)->get();
        $feature = Feature::where('id', $id)->first();
        if($feature->options){
            $output = '';
            if(json_decode($feature->options)){
                foreach( json_decode($feature->options) as $option){
                    $output = $output . $option . '+';
                }
            }else{
                dd(' این ویژگی بصورت غلطی وارد شده است. 09106801685 زنگ بزنید');
            }
            $feature->options = $output;
        }
        $feature['user_id'] = \Auth::id();
        $feature->save();


        if($feature){
	        return view('admin.manage.feature.create', compact('feature','categories') );
        }else{
        	return redirect('/admin/manage/feature');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFeature $request, $id)
    {
    	$feature = Feature::where('id',$id)->first();
        if(!$feature){
        	return redirect('/admin/manage/feature');
        }
    	foreach (Feature::getFillables() as $key) {
    		if( isset($request[$key]) ){
                if($key == 'options'){
                    $options = $request['options'];
                    $array = explode("+", $options);
                    $feature['options'] = json_encode($array);
                }else{
    	    		$feature[$key] = $request[$key];
                }
    		}
    	}
    	$feature['user_id'] = \Auth::id();
    	$feature->save();

    	if($feature){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/feature');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $feature = Feature::where('id',$id)->first();
        if($feature)
        {
        	$feature->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/feature');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/feature');
        }
    }
}
