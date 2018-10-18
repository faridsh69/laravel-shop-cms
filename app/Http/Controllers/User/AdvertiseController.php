<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Category;
use App\Models\AdvertiseView;

class advertiseController extends Controller
{
    public function index(Request $request)
    {
        // for sort or filter
        $sort = $request['sort'];
        $name = $request['name'];
        $order = $request['order'];
        $category = $request['category'];

        $categories = Category::where('type', Category::TYPE_ADVERTISE)->get();

        // filter category_id and title or description
        if($category){
            $advertises_query = Advertise::where('category_id', $category)
                ->where(function($query) use ($name){
                    $query->where('title', 'like', '%'.$name.'%');
                    $query->orWhere('description', 'like', '%'.$name.'%');
                });
        } else {
            $advertises_query = Advertise::where(function($query) use ($name){
                $query->where('title', 'like', '%'.$name.'%');
                $query->orWhere('description', 'like', '%'.$name.'%');
            });
        }

        // sorting if column exist
        if( array_search($sort, advertise::getFillables()) !== false ){
            $advertises_query = $advertises_query->orderBy($sort, $order);
        }

        // paginate with sort and filter
        $advertises = $advertises_query->Active()->orderBy('id', 'desc')
            ->paginate(9)
            ->appends(['sort' => $sort, 'order' => $order, 'name' => $name, 'category' => $category]);

        return view('user.advertise.index', compact('advertises','categories'));
    }

    public function show($id)
    {
        $advertise = advertise::where('id',$id)->first();

        AdvertiseView::create([
            'advertise_id' => $id,
            'user_id' => \Auth::id(),
            'user_ip' => \Request::ip(),
        ]);

        if($advertise){
            return view('user.advertise.show', compact('advertise') );
        }else{
            return redirect('/');
        }
    }
}
