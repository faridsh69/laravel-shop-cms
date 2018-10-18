<?php

namespace App\Http\Controllers\Admin\Manage\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Image;
use \App\Models\Category;
use \App\Models\Article;
use \App\Http\Requests\StoreContentArticle;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:content_manager');
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
		$category = $request['category'];

    	$categories = Category::where('type', Category::TYPE_ARTICLE)->get();
    	
    	// filter category_id and title or content
    	if($category){
			$articles_query = Article::where('category_id', $category)
				->where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		} else {
			$articles_query = Article::where(function($query) use ($name){
			        $query->where('title', 'like', '%'.$name.'%');
			        $query->orWhere('content', 'like', '%'.$name.'%');
			    });
		}

		// sorting if column exist
		if( array_search($sort, Article::getFillables()) !== false ){
	   		$articles_query = $articles_query->orderBy($sort, $order);
	   	}

	   	// paginate with sort and filter
	   	$articles = $articles_query->orderBy('id', 'desc')
	   		->paginate(self::PAGE_SIZE)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
	       
        $query = $request->fullUrlWithQuery([]);
		return view('admin.manage.content.article.index', compact('articles', 'categories', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::where('type', Category::TYPE_ARTICLE)->get();

        return view('admin.manage.content.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentArticle $request)
    {
    	// creating new object for save request
    	$article = new Article();
    	foreach (Article::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$article[$key] = $request[$key];
    		}
    	}
    	$article['user_id'] = \Auth::id();
    	$article->save();

    	\App\Http\Controllers\ImageController::save($request['cropped_image'], $article);
    	if($article){
	    	$request->session()->flash('alert-success', self::MESSAGE_INSERT_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::where('id',$id)->first();

        if($article){
	        return view('admin.manage.content.article.show', compact('article') );
        }else{
        	return redirect('/admin/manage/content/article');
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
    	$categories = Category::where('type', Category::TYPE_ARTICLE)->get();
        $article = Article::where('id',$id)->first();

        if($article){
	        return view('admin.manage.content.article.create', compact('article','categories') );
        }else{
        	return redirect('/admin/manage/content/article');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContentArticle $request, $id)
    {
    	$article = Article::where('id',$id)->first();
        if(!$article){
        	return redirect('/admin/manage/content/article');
        }
    	foreach (Article::getFillables() as $key) {
    		if( isset($request[$key]) ){
	    		$article[$key] = $request[$key];
    		}
    	}
    	$article['user_id'] = \Auth::id();
    	$article->save();

    	// saving image
    	$data = $request['cropped_image'];
        $file_name = $request['file_name'];
        if($data){
            if(!$file_name){
                $file_name = 'no-file-name.png';
            }
            $image = [
                'name' => $file_name, 
                'mime_type' => 'image/png',
                'description' => '',
                'type' => Image::TYPE_ARTICLE,
                'user_id' => \Auth::id(),
            ];

    		// source of file saving
    		$path = '/images/article/';
            $image = Image::create($image);
            $destination_path = storage_path() . $path ;
            $data = explode(",", $data)[1];
            $src = $destination_path . $image->id.'-'.$image->name;
            try {
                file_put_contents($src, base64_decode($data));
            } catch (Exception $e) {
                \Log::error('upload file error');
                \Log::error($e);
            }
            $image->src = '/storage'.$path.$image->id.'-'.$image->name;
            $image->save();

            $article->image_id = $image->id;
            $article->save();
        }
    	if($article){
	    	$request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);
    	}else{
	    	\Log::error('در هنگام ثبت خطا رخ داده است - user with user_id : '. \Auth::id() );
	    	$request->session()->flash('alert-danger', self::MESSAGE_FAILED);
    	}
        return redirect('/admin/manage/content/article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $article = Article::where('id',$id)->first();
        if($article)
        {
        	$article->delete();
        	$request->session()->flash('alert-success', self::MESSAGE_DELETE_SUCCESS);

        	return redirect('/admin/manage/content/article');
        }
        else{
        	$request->session()->flash('alert-danger', self::MESSAGE_NOT_FOUND);
        	\Log::error('در هنگام حذف خطا رخ داده است - user with user_id : '. \Auth::id() );

        	return redirect('/admin/manage/content/article');
        }
    }
}
