<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Baner;
use \App\Http\Requests\StoreBaner;
use \App\Http\Controllers\ImageController;

class BanerController extends Controller
{
    
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
		$baners_query = Baner::where(function($query) use ($name){
		        $query->where('title', 'like', '%'.$name.'%');
		        $query->orWhere('description', 'like', '%'.$name.'%');
		    });

		// sorting if column exist
		if( array_search($sort, Baner::getFillables()) !== false ){
	   		$baners_query = $baners_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$baners = $baners_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name,]);   
	   
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.baner.index', compact('baners','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.baner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBaner $request)
    {
        $baner = $request->all();
        $baner['user_id'] = \Auth::id();
        $baner = Baner::create($baner);
        \App\Http\Controllers\ImageController::save($request['cropped_image'], $baner);

    	if($baner){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/baner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $baner = Baner::where('id',$id)->first();

        if($baner){
	        return view('admin.manage.baner.show', compact('baner') );
        }else{
        	return redirect('/admin/manage/baner');
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
        $baner = Baner::where('id',$id)->first();

        if($baner){
	        return view('admin.manage.baner.create', compact('baner') );
        }else{
        	return redirect('/admin/manage/baner');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBaner $request, $id)
    {
    	$baner = Baner::where('id',$id)->first();
        if(!$baner){
        	return redirect('/admin/manage/baner');
        }
    	foreach (Baner::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$baner[$key] = $request[$key];
    		}
    	}
    	$baner['user_id'] = \Auth::id();
    	$baner->save();

    	\App\Http\Controllers\ImageController::save($request['cropped_image'], $baner);
    	if($baner){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/baner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $baner = Baner::where('id',$id)->first();
        if($baner)
        {
        	$baner->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/baner');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/baner');
        }
    }
}
