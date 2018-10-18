<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Product;
use \App\Http\Requests\StoreProduct;
use \App\Models\RelatedProduct;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:product_manager');
    }

    public function postQuickEdit(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        
        if($product){
            $product->price = $request['price'];
            $product->discount_price = $request['discount_price'];
            $product->inventory = $request['inventory'];
            $product->save();

            $request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
        }else{
            \Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
            $request->session()->flash('alert-danger', self::MESSAGE_FAILED);
        }
        return redirect()->back();
    }
    
    public function getReportExcel()
    {
        $products = Product::get();
        \Excel::create('products', function ($excel) use ($products) {
            $excel->sheet('Sheet 1', function ($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->export('xls');

        return redirect()->back();
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
    	$order = $request['order'];
        $name = $request['name'];
        $category = $request['category'];
		$status = $request['status'];

    	$categories = Category::where('type', Category::TYPE_PRODUCT)->get();
    	
    	// filter category_id and title or content
    	if($category){
			$products_query = Product::where('category_id', $category)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('description', 'like', '%'.$name.'%');
			    });
		} else {
			$products_query = Product::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('description', 'like', '%'.$name.'%');
			    });
		}
        $products_query = $products_query->where('status', 'like', '%'.$status.'%')
            ->withCount('views');

		if( array_search($sort, Product::getFillables()) !== false ){
	   		$products_query = $products_query->orderBy($sort, $order);
        }

        $products = $products_query
            ->orderBy('id', 'desc')
            ->paginate(self::PAGE_SIZE)
            ->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]); 

        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.product.index', compact('products','categories','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::where('type', Category::TYPE_PRODUCT)->get();
        $related_products_all = Product::select('id','title')->get();
        $related_products = [];

        return view('admin.manage.product.create', compact('categories', 'related_products_all', 'related_products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $group_id = rand(1000,9999);
        foreach($request['price'] as $key_array => $item)
        {
            $product = new Product();
            foreach (Product::getFillables() as $key) {
                if( isset($request[$key]) ){
                    if(array_search($key, Product::getFillableArrays()) !== false )
                    {
                        $product[$key] = isset($request[$key][$key_array]) ? $request[$key][$key_array] : null;
                    }else{
                        $product[$key] = $request[$key];
                    }
                }
            }

            $product['group_id'] = $group_id;
            $product['user_id'] = \Auth::id();
            
            $product->save();

            if($request['features'])
            {
                foreach($request['features'] as $key => $data)
                {
                    if ( is_array($data) ) {
                        $data = json_encode($data);
                    }
                    $product->features()->syncWithoutDetaching([$key => ['data' => $data ]]);
                }
            }

            if($request['featuresPrice'])
            {
                foreach($request['featuresPrice'] as $key => $data)
                {
                    $data = $data[$key_array];
                    if ( is_array($data) ) {
                        $data = json_encode($data);
                    }
                    $product->features()->syncWithoutDetaching([$key => ['data' => $data ]]);
                }
            }

            if($request['related_product'])
            {
                foreach($request['related_product'] as $related_product_id)
                {
                    $item = [
                        'product_id' => $product->id,
                        'related_product_id' => $related_product_id,
                    ];
                    RelatedProduct::firstOrCreate( $item );
                }
            }

            // save product image gallery
            foreach($request->all() as $key => $value)
            {
                if (strpos($key, 'gallery') !== false) {
                    $product->images()->syncWithoutDetaching([$value]);
                }
            }
        }

    	if($product){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->first();
        
        if($product){
	        return view('admin.manage.product.show', compact('product') );
        }else{
        	return redirect('/admin/manage/product');
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
        $product = product::where('id',$id)->first();
        $related_products = RelatedProduct::where('product_id',$id)->pluck('related_product_id')->toArray();
        $related_products_all = Product::select('id','title')->get();

        if($product){
	        return view('admin.manage.product.create', compact('product','categories', 'related_products', 'related_products_all') );
        }else{
        	return redirect('/admin/manage/product');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, $id)
    {
        $product = product::where('id',$id)->first();
        if(!$product){
            return redirect('/admin/manage//product');
        }
        foreach (product::getFillables() as $key) {
            if( isset($request[$key]) ){
                $product[$key] = $request[$key];
            }
            if( isset($request[$key]) ){
                if(array_search($key, Product::getFillableArrays()) !== false )
                {
                    $product[$key] = isset($request[$key][0]) ? $request[$key][0] : null;
                }else{
                    $product[$key] = $request[$key];
                }
            }
        }
        $product['user_id'] = \Auth::id();
        $product->save();

        if($request['features'])
        {
            foreach($request['features'] as $key => $data)
            {
                if ( is_array($data) ) {
                    $data = json_encode($data);
                }
                $product->features()->syncWithoutDetaching([$key => ['data' => $data ]]);
            }
        }

        if($request['featuresPrice'])
        {
            foreach($request['featuresPrice'] as $key => $data)
            {
                $data = $data[0];
                if ( is_array($data) ) {
                    $data = json_encode($data);
                }
                $product->features()->syncWithoutDetaching([$key => ['data' => $data ]]);
            }
        }


        foreach($request->all() as $key => $value)
        {
            if (strpos($key, 'gallery') !== false) {
                $product->images()->syncWithoutDetaching([$value]);
            }
        }

        if($request['related_product'])
        {
            foreach($request['related_product'] as $related_product_id)
            {
                $item = [
                    'product_id' => $product->id,
                    'related_product_id' => $related_product_id,
                ];
                RelatedProduct::firstOrCreate( $item );
            }
        }        
        
    	if($product){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $product = Product::where('id',$id)->first();
        if($product)
        {
        	$product->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/product');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/product');
        }
    }
}
