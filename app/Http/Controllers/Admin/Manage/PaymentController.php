<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:payment_manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Payments = Payment::orderBy('id','dsc')->paginate(self::PAGE_SIZE);
        
        return view('admin.content.Payment.index')->withPayments($Payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = \App\Models\Category::get();

        return view('admin.content.Payment.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreContentPayment $request)
    {
    	$Payment = new Payment();
    	foreach ($Payment->getFillables()() as $key) {
    		$Payment[$key] = $request[$key];
    	}
    	$Payment['user_id'] = \Auth::id();
    	$Payment->save();

    	$data = $request['cropped_image'];
        $file_name = $request['file_name'];
        if($data){
            if(!$file_name){
                $file_name = 'noName.png';
            }

            $image = [
                'name' => $file_name, 
                'description' => 'Payment_image', 
                'mime_type' => 'image/png',
                'type' => 'original',
                'user_id' => \Auth::id(),
            ];
            // 'size' => 0
    		// 'ext',
    		// 'src',
    		// 'size',
    		// 'width',
    		// 'height',
    		$path = '/images/Payment/';
            $image = \App\Models\Image::create($image);
            $destination_path = storage_path() . $path ;
            $data = explode(",", $data)[1];
            $src = $destination_path . $image->id.'-'.$image->name;
            try {
                file_put_contents($src, base64_decode($data));
            } catch (Exception $e) {
                Log::error('upload file error');
                Log::error($e);
            }
            if( $request['id'] ){
                $Payment = Payment::where('id',$request['id'])->first();
            }
            $image->src = '/storage'.$path.$image->id.'-'.$image->name;
            $image->save();
            $Payment->image_id = $image->id;
            $Payment->save();
        }
    	if($Payment){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/content/Payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Payment = Payment::where('id',$id)->first();
        if($Payment){
	        return view('admin.content.Payment.show')->withPayment($Payment);
        }else{
        	return redirect('/admin/content/Payment');
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
    	$categories = \App\Models\Category::get();

        $Payment = Payment::where('id',$id)->first();
        if($Payment){
	        return view('admin.content.Payment.create')->withPayment($Payment)->withCategories($categories);
        }else{
        	return redirect('/admin/content/Payment');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\StoreContentPayment $request, $id)
    {
    	$Payment = Payment::where('id',$id)->first();
        if(!$Payment){
        	return redirect('/admin/content/Payment');
        }
    	foreach ($Payment->getFillables()() as $key) {
    		$Payment[$key] = $request[$key];
    	}
    	$Payment['user_id'] = \Auth::id();
    	$Payment->save();

    	$data = $request['cropped_image'];
        $file_name = $request['file_name'];
        if($data){
            if(!$file_name){
                $file_name = 'noName.png';
            }

            $image = [
                'name' => $file_name, 
                'description' => 'Payment_image', 
                'mime_type' => 'image/png',
                'type' => 'original',
            ];
            $image = \App\Models\Image::create($image);
            $destination_path = storage_path() . '/Payment';
            $data = explode(",", $data)[1];
            $src = $destination_path . '/'. $image->id.'-'.$image->name;
            try {
                file_put_contents($src, base64_decode($data));
            } catch (Exception $e) {
                Log::error('upload file error');
                Log::error($e);
            }
            if( $request['id'] ){
                $Payment = Payment::where('id',$request['id'])->first();
            }
            $Payment->image_id = $image->id;
            $Payment->save();
        }
    	if($Payment){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/content/Payment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $Payment = Payment::where('id',$id)->first();
        if($Payment)
        {
        	$Payment->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect()->back();
        }
        else{
        	throw new \Exception("not fount Payment with id = ". $id, 1);

        }
    }
}
