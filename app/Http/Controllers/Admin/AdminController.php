<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Category;

class AdminController extends Controller
{
	public function postManageCategorySort(Request $request)
	{
		dd($request['folders']);
		$i = 0;
		foreach($request['folders'] as $key => $folder) 
		{
			foreach($folder['children'] as $key => $item)
			{
				$category = Category::where('id', $item['id'])->first();
				$category->order = $i;
				$category->save();
				$i ++;
			}
		}

		return 'ok!';
	}

	public function getManageCategoryList()
	{
		$categories = Category::orderBy('order', 'asc')->get();
		$types = Category::$TYPES;

		$output = [];

		foreach ($types as $key => $type) {
			$output[$key] = [
				'text' => $type,
				'type' => 'tree-folder',
				'children' => []
			];
			foreach($categories->where('type', $type) as $category)
			{
				$output[$key]['children'][] = [
					'text' => $category->title,
					'id' => $category->id,
				];
			}
		}
		
		return $output;
	}

	public function getGenerateCode()
	{
		$user = \Auth::user();
		$user->generated_marketer_code = $this->_random_string();;
		$user->save();

		return redirect()->back();
	}

	public function getChangeProvince(Request $request)
	{
		$cities = \Config::get('constants.cities')[$request->id];
		
		return $cities;
	}

	public function getDeleteImage($image_id)
	{
		$image = Image::where('id', $image_id)->first();
		if($image){
			$image->delete();
		}
		return redirect()->back();
	}

	public function postUploadImage(Request $request)
	{
		$image = $request['image'];
		$image = \App\Http\Controllers\ImageController::saveGalleryImage($image);
		if($image['image_id']){
			return [
				'status' => 'success',
				'image_id' => $image['image_id'],
				'src' => $image['src'],
			];
		}else{
			return [
				'status' => 'failed',
				'image_id' => $image['image_id'],
				'src' => $image['src'],
				'url' => $image['url'],
			];
		}
	}

	public function postUploadImageAdvertise(Request $request)
	{
		$image = $request['image'];
		$image = \App\Http\Controllers\ImageController::saveGalleryImageAdvertise($image);
		return [
			'status' => 'success',
			'image_id' => $image['image_id'],
			'src' => $image['src'],
		];
	}
	

	public function postChangeStatus(Request $request)
	{
		$type = $request['type'];
		$id = $request['id'];
		$status = $request['status'];
		// dd($type, $id, $status);
		$message = '';
		switch ($type) {
			case 'category':
				$item = \App\Models\Category::find($id);break;
			case 'brand':
				$item = \App\Models\Brand::find($id);break;
			case 'feature':
				$item = \App\Models\Feature::find($id);break;
			case 'product':
				$item = \App\Models\Product::find($id);break;
			case 'factor':
				$item = \App\Models\Factor::find($id);break;
			case 'user':
				$item = \App\Models\User::find($id);break;
			case 'baner':
				$item = \App\Models\Baner::find($id);break;
			case 'address':
				$item = \App\Models\Address::find($id);break;
			case 'agent':
				$item = \App\Models\Agent::find($id);break;
			case 'tagend':
				$item = \App\Models\Tagend::find($id);break;
			case 'menu':
				$item = \App\Models\Menu::find($id);break;
			case 'advertise':
				$item = \App\Models\Advertise::find($id);break;
			case 'forum':
				$item = \App\Models\Forum::find($id);break;
		}
		if($item)
		{
			$item->status = $status;
			$item->save();
			$message = 'تغییر یافت!';
		}
		else{
			$message = 'خطا!';
		}
		return $message;
	}

    public function getDashboard()
    {
        return view('admin.first-dashboard');
    }

    public function getLogout()
    {
        \Auth::logout();
        
        return redirect('/');
    }

    private function _random_string()
    {
        $characters = '12345678';
        $randstring = '';
        for ($i = 0; $i < 6; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }	
}
