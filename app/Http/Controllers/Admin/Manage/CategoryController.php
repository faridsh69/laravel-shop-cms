<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Http\Requests\StoreCategory;
use \App\Models\Feature;
use \App\Models\Product;
use \App\Models\Brand;
use \App\Models\Advertise; 

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:category_manager');
    // }
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
		$type = $request['type'];
    	$types = Category::TYPE;
    	
    	// filter category_id and title or description
    	if($type){
			$categories_query = Category::where('type', $type)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('description', 'like', '%'.$name.'%');
			    });
		} else {
			$categories_query = Category::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('description', 'like', '%'.$name.'%');
			    });
		}

		// sorting if column exist
		if( array_search($sort, Category::getFillables()) !== false ){
	   		$categories_query = $categories_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$categories = $categories_query->orderBy('id', 'asc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'type' => $type]);

        $query = $request->fullUrlWithQuery([]); 

        $category_product = Category::where('type', Category::TYPE_PRODUCT)->orderBy('id', 'desc')->get();  
        $category_advertise = Category::where('type', Category::TYPE_ADVERTISE)->get();  
        $category_forum = Category::where('type', Category::TYPE_FORUM)->get();  
        $category_page = Category::where('type', Category::TYPE_PAGE)->get();  
        $category_news = Category::where('type', Category::TYPE_NEWS)->get();  
        $category_article = Category::where('type', Category::TYPE_ARTICLE)->get();  
	   
        $category_types = [$category_product, $category_advertise, $category_forum, $category_page, $category_news, $category_article];

		return view('admin.manage.category.index', compact('categories','types','query', 'category_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$types = Category::TYPE;
    	$categories = Category::get();

        return view('admin.manage.category.create', compact('types','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
    	// creating new object for save request
    	$category = new Category();
    	foreach (Category::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$category[$key] = $request[$key];
    		}
    	}
    	$category['user_id'] = \Auth::id();
        if( $category['type'] == null ){
            $category['type'] = 'محصول';
        }
    	$category->save();
        \App\Http\Controllers\ImageController::save($request['cropped_image'],$category);
        
    	if($category){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('id',$id)->first();

        if($category){

	        return view('admin.manage.category.show', compact('category') );
        }else{
        	return redirect('/admin/manage/category');
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
        $category = Category::where('id',$id)->first();

    	$types = Category::TYPE;
        $categories = Category::get();

        if($category){

	        return view('admin.manage.category.create', compact('category','categories','types') );
        }else{
        	return redirect('/admin/manage/category');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, $id)
    {
    	$category = Category::where('id',$id)->first();
        if(!$category){
        	return redirect('/admin/manage/category');
        }
    	foreach (Category::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$category[$key] = $request[$key];
    		}
    	}
    	$category['user_id'] = \Auth::id();
    	$category->save();
        \App\Http\Controllers\ImageController::save($request['cropped_image'],$category);
        
    	if($category){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $category = Category::where('id',$id)->first();
        if($category)
        {
        	$category->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/category');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/category');
        }
    }

    public function postType(Request $request)
    {
        $categories = Category::where('type', $request['type'])->get();
        return [
            'categories' => $categories,
        ]; 
    }

    public function getProductId($id)
    {
        $category_selected = '';
        $features = [];
        $features_price = [];
        $categories = Category::select('id','title')
            ->where('type',Category::TYPE_PRODUCT)
            ->get();
        if($id == 0){
            $products = [new Product()];
        }else{
            $product = Product::where('id', $id)->first();
            $products = [$product];
            $category_selected = $product->category ? $product->category->id : '';
            $features = $product->features_price_no()->toArray();
            $features_price = $product->features_price_affected()->toArray();
            // todo
            // inja bayad chek koni ke age ham gorohie in bazam hast ona ro pass bedi
        }
        return [
            'categories' => $categories,
            'category_selected' => $category_selected,
            'features' => $features,
            'featuresPrice' => $features_price,
            'statuses' => \App\Models\Product::$STATUS,
            'products' => $products,
        ]; 
    }

    public function postFeature(Request $request)
    {
        $features = Feature::where('category_id', $request['category_id'])
            ->priceNo()
            ->get();
        $features_price = Feature::where('category_id', $request['category_id'])
            ->priceAffected()
            ->get();

        return [
            'features' => $features,
            'featuresPrice' => $features_price,
        ]; 
    }

    public function getAdvertiseGropuId($id)
    {
        $categories = Category::select('id','title')->where('type',Category::TYPE_PRODUCT)->get();
        $brands = Brand::get();
        $advertises = Advertise::where('id', $id)->get();
        if(count($advertises) == 0 )
        {
            $advertises = [Advertise::where('id', $id)->first()];
        }
        if($id == 0){
            $advertises = [new Advertise()];
        }
        return [
            'categories' => $categories,
            'brands' => $brands,
            'price_types' => \App\Models\Advertise::$PRICE_TYPES,
            'operators' => \App\Models\Advertise::$OPERATOR_TYPES,
            'sim_cart_types' => \App\Models\Advertise::$SIM_CART_TYPES,
            'advertises' => $advertises,
        ]; 
    }

    public function postAdvertise(Request $request)
    {
        $features = Feature::where('category_id', $request['category_id'])->get();
        return [
            'features' => $features,
        ]; 
    }
}
