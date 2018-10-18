<?php
Route::group(['namespace' => 'User'], function () {
	Route::get('', 'MasterController@index');
	Route::get('components', 'MasterController@getComponents');
	Route::get('language/{name}', 'MasterController@getLanguage');
	Route::group(['prefix' => 'test'], function () {
		// Route::get('form', 'TestController@form');
		// Route::get('test', 'TestController@test');
		// Route::get('test3', 'MasterController@test3');
	});
	Route::group(['prefix' => 'product'], function () {
		Route::get('', 'ProductController@index');
		Route::get('comparison', 'ProductController@getComparison');
		Route::get('comparison/{id}', 'ProductController@getComparison');
		Route::post('comparison/add', 'ProductController@postComparison');
		Route::get('comparison/remove/{id}', 'ProductController@getRemoveComparison');
		Route::get('{id}', 'ProductController@show');
		Route::get('search/{name}', 'ProductController@getSearch');
		Route::get('category/{id}', 'ProductController@index');		
		Route::get('like/{id}', 'ProductController@getLike');		
		Route::post('like', 'ProductController@postLike');		
		Route::post('comment', 'ProductController@postComment')->middleware('auth');		
		// Route::post('comment', 'ProductController@postComment')->middleware('auth');
	});
	Route::group(['prefix' => 'basket'], function () {
		Route::get('product/init', 'BasketController@getProductInit');
		Route::post('add', 'BasketController@postAdd');
		Route::post('product/filter', 'BasketController@getProductFilter');

		Route::get('', 'BasketController@index');
		Route::get('init', 'BasketController@getInit');
		Route::post('count', 'BasketController@postBasketCount');
		Route::post('count/view', 'BasketController@postBasketCountView');
		Route::get('quick-register/{phone}', 'BasketController@getQuickRegister');
	});
	Route::group(['prefix' => 'checkout', 'middleware' => ['auth'] ], function () {
		Route::get('address', 'CheckoutController@getAddress');
		Route::post('address', 'CheckoutController@postAddress');
		Route::get('address/init', 'CheckoutController@getAddressInit');
		Route::get('shipping', 'CheckoutController@getShipping');
		Route::post('shipping', 'CheckoutController@postShipping');
		Route::post('discount', 'CheckoutController@postDiscount');
		Route::get('payment', 'CheckoutController@getPayment');
		Route::get('payment/local', 'CheckoutController@getPaymentLocal');
		Route::get('payment/online/{bank}', 'CheckoutController@getPaymentOnline');
		Route::get('payment/verify', 'CheckoutController@getPaymentVerify');
		Route::post('payment/verify', 'CheckoutController@getPaymentVerify');
	});
	Route::group(['prefix' => 'user'], function () {
		Route::get('login', 'UserController@getLogin')->name('login');
		Route::post('login', 'UserController@postLogin')->middleware('throttle:7,0.2');
		Route::get('register', 'UserController@getRegister');
		Route::post('register', 'UserController@postRegister')->middleware('throttle:7,0.2');
		Route::post('forget-password', 'UserController@postForgetPassword')->middleware('throttle:1,2');
		Route::get('verificate/{id}', 'UserController@getVerificateId');
	});
	Route::resources([
	    'advertise' => 'AdvertiseController',
	    'forum' => 'ForumController',
	],['only' => ['index', 'show']]);
	Route::name('user.')
		->prefix('content')
		->namespace('Content')
		->group(function () {
			Route::resources([
				'article' => 'ArticleController',
			    'news' => 'NewsController',
			    'page' => 'PageController',
		    ],
		    ['only' => ['index', 'show']]);
	});
	Route::group(['prefix' => 'advertise'], function () {
		Route::get('category/{id}', 'AdvertiseController@getCategory');
	});
	Route::group(['prefix' => 'forum'], function () {
		Route::get('category/{id}', 'ForumController@getCategory');
	});
});
Route::group(['prefix' => 'command', 'namespace' => 'Admin\Manage'], function () {
	Route::get('backup-run', 'CommandController@backupRun');
	Route::get('config-cache', 'CommandController@configCache');
	Route::get('cache-clear', 'CommandController@cacheClear');
	Route::get('migrate', 'CommandController@migrate');
	Route::get('db-seed', 'CommandController@dbSeed');
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
	Route::get('logout', 'AdminController@getLogout');
	Route::get('', 'AdminController@getDashboard');
	Route::get('dashboard', 'AdminController@getDashboard');
	Route::post('change-status', 'AdminController@postChangeStatus');
	Route::post('upload-image', 'AdminController@postUploadImage');
	Route::post('upload-image/advertise', 'AdminController@postUploadImageAdvertise');
	Route::get('change-province/{id}', 'AdminController@getChangeProvince');
	Route::get('delete-image/{id}', 'AdminController@getDeleteImage');
	Route::get('generate-code-marketer', 'AdminController@getGenerateCode');
	Route::get('manage/category/list', 'AdminController@getManageCategoryList');
	Route::post('manage/category/sort', 'AdminController@postManageCategorySort');

	Route::group(['prefix' => 'profile'], function () {
		Route::get('', 'ProfileController@index');
		Route::post('', 'ProfileController@update');
		Route::post('address', 'ProfileController@postAddress');
		Route::post('change-password', 'ProfileController@postChangePassword');
		Route::post('charge-credit', 'ProfileController@postChargeCredit');
	});
	Route::resources([
		    'favorite' => 'FavoriteController',
		    'factor' => 'FactorController',
		    // 'payment' => 'PaymentController',
		],['only' => ['index', 'show']]);
	Route::get('factor/report/excel', 'FactorController@getReportExcel');
	Route::resources([
		    'advertise' => 'AdvertiseController',
		    'forum' => 'ForumController',
		]);
	Route::group(['prefix' => 'manage', 'namespace' => 'Manage'], function () {
		Route::resources([
		    'category' => 'CategoryController',
		    'feature' => 'FeatureController',
		    'brand' => 'BrandController',
		    'product' => 'ProductController',
		    'comment' => 'CommentController',
		    'factor' => 'FactorController',
		    // 'payment' => 'PaymentController',
		    'content/article' => 'Content\ArticleController',
		    'content/news' => 'Content\NewsController',
		    'content/page' => 'Content\PageController',
		    'content/menu' => 'Content\MenuController',
		    'advertise' => 'AdvertiseController',
		    'forum' => 'ForumController',
		    'setting' => 'SettingController',
		    'agent' => 'AgentController',
		    'role' => 'RoleController',
		    'message' => 'MessageController',
		    'baner' => 'BanerController',
		    'tagend' => 'TagendController',
		]);
		Route::get('product/report/excel', 'ProductController@getReportExcel');
		Route::post('product/quick-edit/{id}', 'ProductController@postQuickEdit');
		Route::get('user/report/excel', 'UserController@getReportExcel');
		Route::get('user/report/excel/{user_id}', 'UserController@getReportExcelId');
		Route::get('factor/report/excel', 'FactorController@getReportExcel');
		Route::get('factor/{id}/print', 'FactorController@getPrint');
		Route::post('factor/edit/product', 'FactorController@postEditProduct');

		Route::group(['prefix' => 'user','middleware' => ['can:user_manager']], function(){
			Route::get('', 'UserController@index');
			Route::get('{id}', 'UserController@show');
			Route::get('login/{id}', 'UserController@getUserLogin');
			Route::get('notice/all', 'UserController@getNoticeAll');
			Route::post('notice/email', 'UserController@postNoticeEmail');
			Route::post('notice/sms', 'UserController@postNoticeSms');
			Route::post('role', 'UserController@postRole');
			Route::get('{user_id}/remove/role/{role_id}', 'UserController@getRemoveRole');
		});
		Route::group(['prefix' => 'report'], function(){
			Route::get('', 'ReportController@index');
			Route::get('sale-total', 'ReportController@getSaleTotal');
			Route::get('sale-daily', 'ReportController@getSaleDaily');
			Route::get('price-chart', 'ReportController@getPriceChart');

		});
		Route::get('developer/log', 'DeveloperController@getLog');

		Route::post('api/category/type', 'CategoryController@postType');
		Route::get('api/category/product/{id}', 'CategoryController@getProductId');
		Route::post('api/category/feature', 'CategoryController@postFeature');
		Route::get('api/category/advertise/{id}', 'CategoryController@getAdvertiseGropuId');
		Route::post('api/category/advertise', 'CategoryController@postAdvertise');
		Route::group(['prefix' => 'backup'], function () {
			Route::get('', 'BackupController@index');
			Route::get('delete/{file_name}', 'BackupController@delete');
			Route::get('create', 'BackupController@create');
			Route::get('download/{file_name}', 'BackupController@download');
		});
		Route::group(['prefix' => 'command'], function () {
			Route::get('backup-run', 'CommandController@backupRun');
			Route::get('config-cache', 'CommandController@configCache');
			Route::get('migrate', 'CommandController@migrate');
			Route::get('db-seed', 'CommandController@dbSeed');
		});
	});
});
