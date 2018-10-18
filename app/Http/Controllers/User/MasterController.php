<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\News;
use App\Models\Brand;
use App\Models\Baner;
use App\Models\User;
use App\Models\Factor;
use App\Models\Payment;
use App\Http\Services\SmsService;

class MasterController extends Controller
{
    public function getComponents()
    {
        $new_products = Product::Mojod()->Desc()->take(10)->get();
        $discount_products = Product::Discounted()->Mojod()->Desc()->take(10)->get();
        $brands = Brand::Active()->get();
        $newses = News::Active()->get();
        $baners_right_slider = Baner::Active()->where('location', Baner::LOCATION_RIGHT_SLIDER)->get();
        $baners_left_slider = Baner::Active()->where('location', Baner::LOCATION_LEFT_SLIDER)->get();

        return view('user.components', compact('newses', 'brands', 'baners_right_slider', 'baners_left_slider', 'new_products', 'discount_products'));
    }

	public function index() 
    {
    	$new_products = Product::Mojod()->Desc()->take(10)->get();
    	$discount_products = Product::Discounted()->Mojod()->Desc()->take(10)->get();
        $brands = Brand::Active()->get();
    	$newses = News::Active()->get();
    	$baners_right_slider = Baner::Active()->where('location', Baner::LOCATION_RIGHT_SLIDER)->get();
    	$baners_left_slider = Baner::Active()->where('location', Baner::LOCATION_LEFT_SLIDER)->get();

        return view('user.home', compact('newses', 'brands', 'baners_right_slider', 'baners_left_slider', 'new_products', 'discount_products'));
    }

    public function getLanguage($language)
    {
        if($language == 'fa' || $language == 'en'){
            session()->put('local_language', $language);
        }
        
        return redirect()->back();
    }
}

