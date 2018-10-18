<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Agent;
use \App\Models\Address;
use \App\Http\Controllers\ImageController;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:general_manager');
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
		$Agents_query = Agent::where(function($query) use ($name){
		        $query->where('description', 'like', '%'.$name.'%');
		    });

		// sorting if column exist
		if( array_search($sort, Agent::getFillables()) !== false ){
	   		$Agents_query = $Agents_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$agents = $Agents_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name,]);   
	   
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.agent.index', compact('agents','query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.Agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address_array = [
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'lable' => $request->lable,
            'phone' => $request->phone,
            'sabet_phone' => $request->sabet_phone,
            'display_name' => $request->display_name,
            // 'latitude' => $request->latitude,
            // 'longitude' => $request->longitude,
            'user_id' => 1,
            'status' => Address::STATUS_ACTIVE,
        ];
        $address = Address::create($address_array);

        $agent_array = [
            'address_id' => $address->id,
            'brand_id' => $request->brand_id,
            'user_id' => \Auth::id(),
            'description' => $request->description,
            'status' => $request->status,
        ];

        $Agent = Agent::create($agent_array);
        \App\Http\Controllers\ImageController::save($request['cropped_image'], $Agent);

    	if($Agent){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/agent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = Agent::where('id',$id)->first();

        if($agent){
	        return view('admin.manage.agent.show', compact('agent') );
        }else{
        	return redirect('/admin/manage/agent');
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
        $agent = Agent::where('id',$id)->first();

        if($agent){
            $agent->display_name = $agent->address->display_name;
            $agent->phone = $agent->address->phone;
            $agent->sabet_phone = $agent->address->sabet_phone;
            $agent->postal_code = $agent->address->postal_code;
            $agent->province = $agent->address->province;
            $agent->city = $agent->address->city;
            $agent->real_address = $agent->address->address;

	        return view('admin.manage.agent.create', compact('agent') );
        }else{
        	return redirect('/admin/manage/agent');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$Agent = Agent::where('id',$id)->first();
        if(!$Agent){
        	return redirect('/admin/manage/agent');
        }
        // todo address o bayad joda update koni
    	foreach (Agent::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$Agent[$key] = $request[$key];
    		}
    	}
    	$Agent['user_id'] = \Auth::id();
    	$Agent->save();

    	\App\Http\Controllers\ImageController::save($request['cropped_image'], $Agent);
    	if($Agent){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/agent');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $Agent = Agent::where('id',$id)->first();
        if($Agent)
        {
        	$Agent->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/agent');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/agent');
        }
    }
}
