<?php

namespace App\Http\Controllers\Admin\Manage\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Menu;
use \App\Http\Requests\StoreMenu;
use \App\Models\Feature;
use \App\Models\Product;
use \App\Models\Brand;
use \App\Models\Advertise; 

class MenuController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:menu_manager');
    // }

    public function index(Request $request)
    {
    	// for sort or filter
        $name = $request['name'];
    	$sort = $request['sort'];
    	$order = $request['order'];
    	
    	// filter menu_id and title or description
    	$menus_query = Menu::where(function($query) use ($name){
            $query->where('title', 'like', '%'.$name.'%');
        });

		// sorting if column exist
		if( array_search($sort, Menu::getFillables()) !== false ){
	   		$menus_query = $menus_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$menus = $menus_query->orderBy('id', 'asc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name]);

        $query = $request->fullUrlWithQuery([]); 

        $menu_footer = menu::where('location', menu::LOCATION_FOOTER)->get();  
        $menu_header = menu::where('location', menu::LOCATION_HEADER)->get();  
	   
        $menu_types = [
                ['menus' => $menu_footer, 'key' => 'footer'], 
                ['menus' => $menu_header, 'key' => 'header'],
            ];

		return view('admin.manage.content.menu.index', compact('menus','query', 'menu_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$menus = Menu::get();

        return view('admin.manage.content.menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenu $request)
    {
    	// creating new object for save request
    	$menu = new Menu();
    	foreach (Menu::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$menu[$key] = $request[$key];
    		}
    	}
    	$menu['user_id'] = \Auth::id();
    	$menu->save();
        
    	if($menu){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::where('id',$id)->first();

        if($menu){
	        return view('admin.manage.content.menu.show', compact('menu') );
        }else{
        	return redirect('/admin/manage/content/menu');
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
        $menu = Menu::where('id',$id)->first();

        $menus = Menu::get();

        if($menu){
	        return view('admin.manage.content.menu.create', compact('menu','menus') );
        }else{
        	return redirect('/admin/manage/content/menu');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMenu $request, $id)
    {
    	$menu = Menu::where('id',$id)->first();
        if(!$menu){
        	return redirect('/admin/manage/content/menu');
        }
    	foreach (Menu::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$menu[$key] = $request[$key];
    		}
    	}
    	$menu['user_id'] = \Auth::id();
    	$menu->save();
        
    	if($menu){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $menu = Menu::where('id',$id)->first();
        if($menu)
        {
        	$menu->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/menu');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/menu');
        }
    }
}
