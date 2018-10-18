<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Message;

class MessageController extends Controller
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
		$messages_query = Message::whereNotNull('id');
		// sorting if column exist
		if( array_search($sort, Message::getFillables()) !== false ){
	   		$messages_query = $messages_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$messages = $messages_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name,]);   
	   
        $query = $request->fullUrlWithQuery([]);

		return view('admin.manage.message.index', compact('messages','query'));
    }
}
