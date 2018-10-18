<?php

namespace App\Http\Controllers\User\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use App\Models\PageView;

class PageController extends Controller
{
    public function index(Request $request)
    {
        // for sort or filter
        $sort = $request['sort'];
        $name = $request['name'];
        $order = $request['order'];
        $category = $request['category'];

        $categories = Category::where('type', Category::TYPE_PAGE)->get();
        
        // filter category_id and title or content
        if($category){
            $pages_query = Page::where('category_id', $category)
                ->where(function($query) use ($name){
                    $query->where('title', 'like', '%'.$name.'%');
                    $query->orWhere('content', 'like', '%'.$name.'%');
                });
        } else {
            $pages_query = Page::where(function($query) use ($name){
                    $query->where('title', 'like', '%'.$name.'%');
                    $query->orWhere('content', 'like', '%'.$name.'%');
                });
        }

        // sorting if column exist
        if( array_search($sort, Page::getFillables()) !== false ){
            $pages_query = $pages_query->orderBy($sort, $order);
        }

        // paginate with sort and filter
        $pages = $pages_query->orderBy('id', 'desc')
            ->paginate(9)
            ->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);   
    
        return view('user.content.page.index', compact('pages','categories'));
    }

    public function show($id)
    {
        $page = Page::where('id',$id)->first();

        PageView::create([
            'page_id' => $id,
            'user_id' => \Auth::id(),
            'user_ip' => \Request::ip(),
        ]);
        if($page){
            return view('user.content.page.show', compact('page') );
        }else{
            return redirect('/');
        }
    }
}
