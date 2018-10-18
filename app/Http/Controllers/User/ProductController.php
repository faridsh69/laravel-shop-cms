<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Basket;
use App\Models\Factor;
use App\Models\Feature;
use App\Models\ProductView;
use App\Models\Comment;
use App\Models\Like;
use App\Http\Requests\StoreLike;
use App\Http\Requests\StoreComment;

class ProductController extends Controller
{
    // load more 
    // paginate with category and sort

	public function index(Request $request)
    {
   		return view('user.product.index');	
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        $comments = Comment::where('product_id', $product->id)->get();
        $comments = $product->comments();

        if($product){
            ProductView::create([
                'product_id' => $id,
                'user_id' => \Auth::id(),
                'user_ip' => \Request::ip(),
            ]);

            $related_products = $product->related_product_items();

            return view('user.product.show', compact('product', 'comments', 'related_products') );
        }else{
            return redirect('/');
        }
    }


    public function getSearch($name)
    {
        $i = 1 ;
        $products = \App\Models\Product::select('id','title')->Active()->get();
        $q = $name;
        if (strlen($q)>0) {
            $hint="";
            foreach($products as $product)
            {
                if (stristr($product['title'],$q)) {
                    if ($hint=="") {
                        $hint="<ul><li><a href='/product/".
                            $product['id'] .
                            "' target='_self'>" .
                            $product['title'] . "</a></li>";
                    } else {
                        $i ++ ;
                        if($i > 6){
                            return $hint;
                        }
                        $hint=$hint . "<li><a href='/product/" .
                            $product['id'] .
                            "' target='_self'>" .
                            $product['title'] . "</a></li>";
                    }
                }
            }
        }
        return $hint;
        $out = "<ul>
            <li><a href='/type/1'>ظروف یکبار مصرف یک</a></li>
            <li><a href='/type/2'>ظروف یکبار مصرف دو</a></li>
            <li><a href='/type/3'>ظروف یکبار مصرف سه</a></li>
            <li><a href='/type/4'>ظروف یکبار مصرف چهار</a></li>
        </ul>";
    }

    public function getLike($id)
    {
        $product = Product::where('id', $id)->first();

        if (!$product)
            return false;
        
        $totalLike = Like::where('product_id', $product->id)
            ->where('type', Like::TYPE_LIKE)
            ->count();
        $totalDislike = Like::where('product_id', $product->id)
            ->where('type', Like::TYPE_DISLIKE)
            ->count();
        
        return [
            'totalLike' => $totalLike,
            'totalDislike' => $totalDislike,
        ];
    }
    
    public function postComment(StoreComment $request)
    {
        sleep(0.1); // it had to be changed TODO
        
        $product = Product::where('id', $request->product_id)->first();
        
        if ($product) {
            Comment::create([
                'comment' => $request->comment,
                'product_id' => $product->id,
                'user_id' => \Auth::id(),
                'status' => Comment::STATUS_DEACTIVE,
            ]);
            $request->session()->flash('alert-success', 'با موفقیت ثبت شد!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('alert-danger', 'محصولی با این کد یافت نشد!');
            return redirect()->back();
        }
    }
    
    public function postLike(StoreLike $request)
    {
        $type = $request->type;
        $product_id = $request->product_id;
        $like = Like::where('product_id', $product_id)
            ->where('user_id', \Auth::id())
            ->first(); 
        if($like)
        {
            if ($like->type != $type) {
                $like->type = $type;
                $like->save();
            }
        }
        else
        {
            $like = Like::create([
                'type' => $type,
                'product_id' => $product_id,
                'user_id' => \Auth::id()
            ]);
        }
        return 'ok';
    }

    public function postComparison(Request $request)
    {
        $id = $request->product_id;
        $product = Product::where('id', $id)
            ->first();
        if($product)
        {
            $session_comparison_list = $request->session()->get('comparison_product.list');
            if( isset($session_comparison_list) && count($request->session()->get('comparison_product.list')) > 4 ){
                $request->session()->flash('alert-success', 'حداکثر 5 محصول قابل مقایسه هستند!');
            }else{
                $request->session()->push('comparison_product.list', $id);
                $request->session()->flash('alert-success', 'با موفقیت اضافه شد!');
            }
        }
        else{
            $request->session()->flash('alert-danger', 'محصول با این کد یافت نشد!');
        }
        return redirect()->back();
    }

    public function getRemoveComparison(Request $request)
    {
        $id = $request->id;
        $product_list = $request->session()->get('comparison_product.list');
        foreach($product_list as $key => $item)
        {
            if($item == $id)
                unset($product_list[$key]);
        }        
        $request->session()->put('comparison_product.list', $product_list);

        return redirect()->back();
    }
    
    public function getComparisonCode($id, Request $request)
    {
        $product = Product::where('id', $id)
            ->first();
        if($product)
        {
            $session_comparison_list = $request->session()->get('comparison_product.list');
            if( isset($session_comparison_list) && count($request->session()->get('comparison_product.list')) > 4 ){
                $request->session()->flash('alert-success', 'حداکثر 5 ملک قابل مقایسه هستند!');
            }else{
                $request->session()->push('comparison_product.list', $code);
                $request->session()->flash('alert-success', 'با موفقیت اضافه شد!');
            }
            return redirect('/product/comparison');
        }
        else{
            $request->session()->flash('alert-danger', 'ملکی با این کد یافت نشد!');
            return redirect()->back();
        }
    }

    public function getComparison(Request $request)
    {
        $product_id_list = $request->session()->get('comparison_product.list');
        if(!$product_id_list)
            $product_id_list = [];
        
        $products = [];
        $features = [];
        $product_datas = [];

        foreach ($product_id_list as $key => $product_id) {
            $product = Product::where('id', $product_id)->first();
            $products[] = $product;
            $features[] = $product->features;
        }
        
        return view('user.product.comparison', [
            'products' => $products,
            'features' => $features,
            'product_datas' => $product_datas,
        ]);
        
    }
}
