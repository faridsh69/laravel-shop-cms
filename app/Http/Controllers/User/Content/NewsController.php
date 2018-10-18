<?php

namespace App\Http\Controllers\User\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Models\NewsView;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // for sort or filter
        $sort = $request['sort'];
        $name = $request['name'];
        $order = $request['order'];
        $category = $request['category'];

        $categories = Category::where('type', Category::TYPE_NEWS)->get();
        
        // filter category_id and title or content
        if($category){
            $newses_query = News::where('category_id', $category)
                ->where(function($query) use ($name){
                    $query->where('title', 'like', '%'.$name.'%');
                    $query->orWhere('content', 'like', '%'.$name.'%');
                });
        } else {
            $newses_query = News::where(function($query) use ($name){
                    $query->where('title', 'like', '%'.$name.'%');
                    $query->orWhere('content', 'like', '%'.$name.'%');
                });
        }

        // sorting if column exist
        if( array_search($sort, News::getFillables()) !== false ){
            $newses_query = $newses_query->orderBy($sort, $order);
        }

        // paginate with sort and filter
        $newses = $newses_query->orderBy('id', 'desc')
            ->paginate(9)
            ->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
    
        return view('user.content.news.index', compact('newses','categories'));
    }

    public function show($id)
    {
        $news = News::where('id',$id)->first();

        NewsView::create([
            'news_id' => $id,
            'user_id' => \Auth::id(),
            'user_ip' => \Request::ip(),
        ]);
        if($news){
            return view('user.content.news.show', compact('news') );
        }else{
            return redirect('/');
        }
    }
}
