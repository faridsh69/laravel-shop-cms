<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:comment_manager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('id','dsc')->paginate(self::PAGE_SIZE);
        
        $query = $request->fullUrlWithQuery([]);

        return view('admin.content.Comment.index',compact('comments','query') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = \App\Models\Category::get();

        return view('admin.content.Comment.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreContentComment $request)
    {
    	$Comment = new Comment();
    	foreach ($Comment->getFillables()() as $key) {
    		$Comment[$key] = $request[$key];
    	}
    	$Comment['user_id'] = \Auth::id();
    	$Comment->save();

    	if($Comment){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/content/Comment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Comment = Comment::where('id',$id)->first();
        if($Comment){
	        return view('admin.content.Comment.show')->withComment($Comment);
        }else{
        	return redirect('/admin/content/Comment');
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

        $Comment = Comment::where('id',$id)->first();
        if($Comment){
	        return view('admin.content.Comment.create')->withComment($Comment)->withCategories($categories);
        }else{
        	return redirect('/admin/content/Comment');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\StoreContentComment $request, $id)
    {
    	$Comment = Comment::where('id',$id)->first();
        if(!$Comment){
        	return redirect('/admin/content/Comment');
        }
    	foreach ($Comment->getFillables()() as $key) {
    		$Comment[$key] = $request[$key];
    	}
    	$Comment['user_id'] = \Auth::id();
    	$Comment->save();

    	
    	if($Comment){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/content/Comment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $Comment = Comment::where('id',$id)->first();
        if($Comment)
        {
        	$Comment->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect()->back();
        }
        else{
        	throw new \Exception("not fount Comment with id = ". $id, 1);

        }
    }
}
