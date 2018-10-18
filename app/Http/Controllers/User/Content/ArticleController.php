<?php

namespace App\Http\Controllers\User\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\ArticleView;

class ArticleController extends Controller
{
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
	   	$articles = $articles_query->Active()->orderBy('id', 'desc')
	   		->paginate(9)
	   		->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
	
		return view('user.content.article.index', compact('articles','categories'));
    }

    public function show($id)
    {
        $article = Article::where('id',$id)->first();

        ArticleView::create([
			'article_id' => $id,
			'user_id' => \Auth::id(),
        	'user_ip' => \Request::ip(),
        ]);
        if($article){
	        return view('user.content.article.show', compact('article') );
        }else{
        	return redirect('/');
        }
    }
}
