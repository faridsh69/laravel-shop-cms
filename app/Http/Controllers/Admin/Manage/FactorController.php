<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Product;
use \App\Models\Category;
use \App\Models\Factor;
use \App\Http\Requests\StoreFactor;

class FactorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:factor_manager');
    }

    public function getPrint($id)
    {
        $factor = Factor::where('id', $id)->first();

        if($factor){
            return view('admin.manage.factor.print', compact('factor'));
        }
        else{
            dd('خطای پرینت');
            throw abort(404);
        }
    }

    public function postEditProduct(Request $request)
    {
        $product_id = $request->product_id;
        $factor_id = $request->factor_id;
        $count = $request->count;
        self::_changeCountProductFactor($product_id, $count, $factor_id);

        $request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
        return redirect()->back();
    }   

    public static function _changeCountProductFactor($product_id, $count, $factor_id)
    {
        $factor = Factor::find($factor_id);
        $product = Product::find($product_id);
        if($count == 0){
            $factor->products()->detach([$product_id]);
        }else{
            $factor->products()->syncWithoutDetaching([
                $product->id => [
                    'count' => $count,
                    'price' =>  $product->price,
                    'discount_price' =>  $product->discount_price,
                ]
            ]);
        }
        $factor->total_price = $factor->calculateTotalPriceWithTagends();
        $factor->save();
    }

    public function getReportExcel()
    {
        $factores = Factor::get();
        \Excel::create('factores', function ($excel) use ($factores) {
            $excel->sheet('Sheet 1', function ($sheet) use ($factores) {
                $sheet->fromArray($factores);
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
        $date_from = $request['date_from'];
        $date_to = $request['date_to'];
    	$sort = $request['sort'];
		$last_name = $request['last_name'];
    	$order = $request['order'];
        $category = $request['category'];
		$status = $request['status'];
    	$role = $request['role'];
    	
        // filter category_id and title or content
    	if($category){
			$factors_query = Factor::where('id', $category)
                ->whereHas('user', function($user_query) use ($last_name){
                    $user_query->where('last_name', 'like', '%'.$last_name.'%');
			    });
		} else {
			$factors_query = Factor::whereHas('user', function($user_query) use ($last_name){
                    $user_query->where('last_name', 'like', '%'.$last_name.'%');
                });
		}

        $factors_query = $factors_query->where('status', '>', 2);
        

        $factors_query = $factors_query->checkUserRole($role);
        
        if($date_from)
        {
            $date = explode('/', $date_from);
            $date = \Nopaad\jDateTime::toGregorian($date[0], $date[1], $date[2]);
            $date = implode('-', $date);
            $date .= ' 00:00:00';
            $factors_query = $factors_query->where('created_at','>=',$date);
        }

        if($date_to)
        {
            $date = explode('/', $date_to);
            $date = \Nopaad\jDateTime::toGregorian($date[0], $date[1], $date[2]);
            $date = implode('-', $date);
            $date .= ' 23:59:59';
            $factors_query = $factors_query->where('created_at', '<=', $date);
        }

		// sorting if column exist
		if( array_search($sort, Factor::getFillables()) !== false ){
	   		$factors_query = $factors_query->orderBy($sort, $order);
	   	}

        if($sort == 'user')
        {
            $factors_query->join('users as us', 'us.id', '=', 'factors.user_id')
                ->orderBy('us.last_name', $order)
                ->select('factors.*');
        }
        if($status){
            $factors_query = $factors_query->where('factors.status', 'like', '%'.$status.'%');
        }

	   	// paginate with sort and filter
	   	$factors = $factors_query->orderBy('admin_seen', 'asc')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'last_name' => $last_name, 'category' => $category, 'date_from' => $date_from, 'date_to' => $date_to, 'status' => $status, 'role' => $role]);   
	    
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.factor.index', compact('factors','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactor $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factor = Factor::where('id',$id)->first();
        if($factor->admin_seen != 1)
        {
            $factor->admin_seen = 1;
            $factor->save();
        }
        if($factor){
	        $address = $factor->address;

	        return view('admin.manage.factor.show', compact('factor','address') );
        }else{
        	return redirect('/admin/manage/factor');
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
        $factor = Factor::where('id',$id)->first();
        $products = Product::get();

        // inja bayad active ha bashe faghat todo

        if($factor){
            $address = $factor->address;

            return view('admin.manage.factor.create', compact('factor','address', 'products') );
        }else{
            return redirect('/admin/manage/factor');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFactor $request, $id)
    {
    	$factor = Factor::where('id',$id)->first();
        if(!$factor){
        	return redirect('/admin/manage/factor');
        }
    	foreach (Factor::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$factor[$key] = $request[$key];
    		}
    	}
    	$factor['user_id'] = \Auth::id();
    	$factor->save();

    	if($factor){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/factor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
    }
}
