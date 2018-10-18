<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Setting;
use \App\Http\Requests\StoreSetting;

class settingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:general_manager');
    }

    public function index(Request $request)
    {
	   	$settings = Setting::orderBy('id', 'asc')->get();   
	
		return view('admin.manage.setting.index', compact('settings'));
    }

    // public function create()
    // {
    //     return view('admin.manage.setting.create');
    // }

    public function store(StoreSetting $request)
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
        $setting = Setting::where('id',$id)->first();

        if($setting){
	        return view('admin.manage.setting.show', compact('setting') );
        }else{
        	return redirect('/admin/manage/setting');
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
        $setting = Setting::where('id',$id)->first();

        if($setting){
	        return view('admin.manage.setting.create', compact('setting') );
        }else{
        	return redirect('/admin/manage/setting');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSetting $request, $id)
    {
        \Cache::forget('constant');
        $setting = Setting::where('id',$id)->first();
        if(!$setting){
            return redirect('/admin/manage/setting');
        }
        if($setting->key == 'logo' || $setting->key == 'default_image' || $setting->key == 'default_image_user' || $setting->key == 'default_image_product' || $setting->key == 'favicon'){
            $url = \App\Http\Controllers\ImageController::saveSetting($request['value'], $setting->key);
            $setting['value'] = '/' . $url;
        }else{
            $setting['value'] = $request->input('value');
        }
        $setting->save();

    	if($setting){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/setting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $setting = Setting::where('id',$id)->first();
        if($setting)
        {
        	$setting->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/setting');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/setting');
        }
    }
}
