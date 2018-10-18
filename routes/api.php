<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/// $table->string('api_token', 60)->unique();

// Auth::guard('api')->user();

// Route::group(['prefix' => 'v1', 'middleware' => 'auth:api', 'namespace' => 'Api'], function () {
Route::group(['prefix' => 'auth', 'namespace' => 'User'], function () {
    Route::group(['prefix' => 'test'], function () {
        Route::post('activation-code','TestController@postActivationCode');
        Route::post('check-code','TestController@postCheckCode');
    });
});


Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::post('login', 'UserController@postLogin');
    Route::post('signup', 'UserController@postSignUp');
    Route::get('article', 'ArticleController@index');
    Route::get('brand', 'BrandController@index');
    Route::get('product', 'ProductController@index');
    Route::get('product/newest/get', 'ProductController@newest');
    Route::get('product/bestsellers/get', 'ProductController@bestsellers');
    Route::get('product/{id}', 'ProductController@show');
    Route::get('category', 'CategoryController@index');
    Route::post('category/products', 'CategoryController@showcategoryproducts');
    Route::post('category/advertise', 'CategoryController@showcategoryadvertise');

    Route::get('setting', 'SettingController@index');

    Route::get('banners/main-banners', 'BannerController@get_main_banners');
    Route::get('banners/ads-banners', 'BannerController@get_ads_banners');


    Route::post('forgetpassword', 'ForgetPasswordController@postPhone');
    Route::post('forgetpassword/code', 'ForgetPasswordController@postPhoneCode');
    Route::post('forgetpassword/password', 'ForgetPasswordController@postPhonePassword');

    Route::get('factor', 'FactorController@index');
    Route::get('factor/{id}', 'FactorController@show');
    Route::post('factor/getuserfactors', 'FactorController@getuserfactores');
    Route::post('factor/getuserfactordetails', 'FactorController@getuserfactordetails');


    Route::get('advertise', 'AdvertiseController@index');
    Route::post('advertise/create', 'AdvertiseController@createadvertise');
    Route::post('advertise/create-multi-advertise', 'AdvertiseController@createMultiAdvertise');
    Route::get('advertise/categories', 'AdvertiseController@getallcategories');
    Route::get('advertise/{id}', 'AdvertiseController@show');
    Route::get('advertise/category/{category}', 'AdvertiseController@showcategory');
    Route::post('advertise/myads/', 'AdvertiseController@getUserAds');
    Route::get('advertise/newest/get', 'AdvertiseController@newest');
    Route::post('advertise', 'AdvertiseController@create');


    // create this web services
    //Route::post('user/change-password', 'UserController@postChangePassword');
    Route::post('profile/edit', 'UserController@update');
    Route::post('profile/setprofilephoto', 'UserController@setuserprofilephoto');
    Route::post('profile/set-user-shop-photo', 'UserController@setusershopphoto');
    Route::post('profile/set-user-visit-photo', 'UserController@setuservisitphoto');
    Route::post('profile/set-user-javaz-photo', 'UserController@setuserjavazphoto');
    Route::post('profile/activationcode', 'UserController@sendactivationcode');
    Route::post('profile/activateuser', 'UserController@getactivationcode');
    Route::post('profile/change-password', 'UserController@changeUserPassword');
    Route::post('profile/liked-products', 'UserController@userLikedProducts');


    Route::post('product/like', 'ProductController@add_likes_to_products');
    Route::post('product/remove-like', 'ProductController@remove_likes_from_products');


    Route::post('basket/change-count', 'BasketController@_changeApiCountBasket');
    Route::post('basket/', 'BasketController@_get_Api_UserBasket');
    Route::post('basket/get-basket-contents', 'BasketController@_get_Api_UserBasketContents');


    Route::post('search', 'SearchController@index');
    Route::post('search-by-filter', 'SearchController@searchByFilter');




    Route::get('representations', 'RepresentationController@index');
    Route::post('representations/filter', 'RepresentationController@filter');
    Route::post('representations/get-by-brands', 'RepresentationController@getByBrands');


    Route::post('agents', 'AgentsController@index');
    Route::post('agents/filter', 'AgentsController@filter');



//    Route::post('basket/create-basket', 'BasketController@createBasket');
//    Route::post('basket/add-product', 'BasketController@addToBasket');
//    Route::post('basket/delete-product', 'BasketController@deleteFromBasket');
//    Route::post('basket/delete-basket', 'BasketController@deleteBasket');



});

// Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
// 	Route::group(['prefix' => 'basket'], function () {
// 		Route::post('add', 'BasketController@postAdd');
// 		Route::get('init', 'BasketController@getInit');
// 	});
// });
