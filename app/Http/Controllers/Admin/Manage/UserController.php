<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Role;
use \App\Models\User;
use \App\Models\Message;
use \App\Http\Requests\StoreUser;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user_manager');
    }

    public function getReportExcel()
    {
        $users = User::get();
        \Excel::create('users', function ($excel) use ($users) {
            $excel->sheet('users', function ($sheet) use ($users) {
                $sheet->fromArray($users);
            });
        })->export('xls');

        return redirect()->back();
    }

    public function getReportExcelId($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $users = collect([$user]);
        \Excel::create('users', function ($excel) use ($users) {
            $excel->sheet('users', function ($sheet) use ($users) {
                $sheet->fromArray($users);
            });
        })->export('xls');

        return redirect()->back();
    }    

    public function getRemoveRole($user_id, $role_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->roles()->detach([$role_id]);

        return redirect()->back();
    }

    public function getNoticeAll()
    {
        return view('admin.manage.user.notice');
    }

    public function postNoticeEmail(Request $request)
    {
        // dd( \Config::get('mail.password'));
        $users_list_id = $request->users_list_id;
        $content = $request->content;

        Message::create([
            'message' => $content,
            'users_list_id' => $users_list_id,
            'status' => Message::STATUS_SENDING,
            'user_id' => \Auth::user()->id,
        ]);
        foreach(json_decode($users_list_id) as $user_id)
        {
            $user = User::find($user_id);
            if($user)
            {
                $email = $user->email;
                 \Mail::to(\Auth::user())->send(new \App\Mail\NoticeEmail($content));
            }
        }
        return redirect()->back();
    }

    public function postNoticeSms(Request $request)
    {
        $user = \Auth::user();
        $content = $request->content;
        \App\Http\Services\SmsService::send($user, $content);

        return redirect()->back();
    }

	public function getUserLogin($id)
    {
        if (\Auth::loginUsingId($id)):
            return redirect('/');
        else:
            return back()->withError('Error occurred.');
        endif;
    }

    public function postRole(Request $request)
	{
		$this->validate($request, [
			'role_id' => 'required|in:' . implode(",", \App\Models\Role::orderBy('id', 'asc')->pluck('id')->toArray()),
			'user_id' => 'required|in:' . implode(",", \App\Models\User::orderBy('id', 'asc')->pluck('id')->toArray()),
		]);
		\App\Models\User::where('id', $request->get('user_id'))->first()->roles()->sync([$request->get('role_id')], false);
        \Log::info('role_id: '. $request->get('role_id') . ' to user_id: ' . $request->get('user_id') . 
        ' by user_id: ' . \Auth::id() );
		return redirect()->back();
	}

    public function index(Request $request)
    {
    	// for sort or filter
    	$sort = $request['sort'];
		$name = $request['name'];
    	$order = $request['order'];
        $phone = $request['phone'];
    	$status = $request['status'];
    	$role = $request['role'];

    	// filter category_id and name and phone
		$users_query = User::where('phone', 'like', '%'.$phone.'%')
			->where(function($query) use ($name){
		        $query->where('first_name', 'like', '%'.$name.'%');
		        $query->orWhere('last_name', 'like', '%'.$name.'%');
		    });

        $users_query = $users_query->where('status', 'like', '%'.$status.'%');
		// sorting if column exist
		if( array_search($sort, User::getFillables()) !== false ){
	   		$users_query = $users_query->orderBy($sort, $order);
	   	}

        $users_query = $users_query->checkUserRole($role);

	   	// paginate with sort and filter
	   	$users = $users_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name,]);

        $query = $request->fullUrlWithQuery([]);
        $users_list_id = $users_query->get()->pluck('id');

		return view('admin.manage.user.index', compact('users', 'categories', 'query', 'users_list_id'));
    }

    public function show($id)
    {
        $user = User::where('id',$id)->first();

        if($user){
	        return view('admin.manage.user.show', compact('user') );
        }else{
        	return redirect('/admin/manage/user');
        }
    }
}
