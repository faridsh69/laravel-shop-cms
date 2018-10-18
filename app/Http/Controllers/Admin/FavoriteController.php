<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Like;
use \App\Models\Product;
use \App\Http\Requests\Storefavorite_product;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
    	// for sort or filter
    	$sort = $request['sort'];
		$name = $request['name'];
    	$order = $request['order'];

        $like_product_ids = Like::Mine()->Like()->pluck('product_id')->toArray();

        $favorite_products_query = Product::whereIn('id', $like_product_ids);

		if( array_search($sort, Product::getFillables()) !== false ){
	   		$favorite_products_query = $favorite_products_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$favorite_products = $favorite_products_query->orderBy('id', 'desc')
	   		->get();   
	    
        $query = $request->fullUrlWithQuery([]);
		return view('admin.favorite.index', compact('favorite_products','query'));
    }

}
