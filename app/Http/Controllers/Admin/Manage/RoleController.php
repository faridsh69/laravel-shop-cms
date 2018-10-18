<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Role;
use \App\Http\Requests\StoreRole;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user_manager');
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
		$roles_query = Role::where(function($query) use ($name){
		        $query->where('name', 'like', '%'.$name.'%');
		        $query->orWhere('description', 'like', '%'.$name.'%');
		    });

		// sorting if column exist
		if( array_search($sort, Role::getFillables()) !== false ){
	   		$roles_query = $roles_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$roles = $roles_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name,]);   
	    
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.role.index', compact('roles','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        $array = [];
        foreach($request->permissions as $key => $value)
        {
            $array[] = $value;
        }
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->permissions = json_encode($array);
        $role->save();
    	if($role){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::where('id',$id)->first();

        if($role){
	        return view('admin.manage.role.show', compact('role') );
        }else{
        	return redirect('/admin/manage/role');
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
        $role = Role::where('id',$id)->first();

        if($role){
	        return view('admin.manage.role.create', compact('role') );
        }else{
        	return redirect('/admin/manage/role');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRole $request, $id)
    {
    	$role = Role::where('id',$id)->first();
        if($role){
            $array = [];
            foreach($request->permissions as $key => $value)
            {
                $array[] = $value;
            }
            $role->name = $request->name;
            $role->description = $request->description;
            $role->permissions = json_encode($array);
            $role->save();
        }else{
        	return redirect('/admin/manage/role');
        }
    	if($role){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $role = Role::where('id',$id)->first();
        if($role)
        {
        	$role->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/role');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/role');
        }
    }
}
