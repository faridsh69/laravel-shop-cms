<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Image as ImageModel;

class ImageController
{
    public static function saveSetting($file, $type)
    {
        if(!$file){
            return 1;
        }
        $image = Image::make($file);
        $name =  $type . rand(10000,99999) . '.png';
        $url = 'upload/images/setting/original/' . $name;
        $url100 = 'upload/images/setting/100/' . $name;
        $url400 = 'upload/images/setting/400/' . $name;
        $image->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($url);
        $image->resize(150, 150)->save($url100);
        $image->resize(400, 400)->save($url400);

        $image_model = ImageModel::create([
            'name' => $name,
            'description' => 'original',
            'alt' => $type,
            'type' => $type,
            'mime_type' => 'image/png',
            'ext' => 'png',
            'src' => '/' . $url,
            'src100' => '/' . $url100,
            'src400' => '/' . $url400,
            // 'size', save size image
            'width' => $image->width(),
            'height' => $image->height(),
            'user_id' => \Auth::id(),
        ]);

        return $url;
    }

    public static function saveProfile($file, $model, $image_type)
    {
        if(!$file){
            return 1;
        }
        $image = Image::make($file);
        $name = $image_type . rand(10000,99999) . $model->id . '.png';
        $type = strtolower(class_basename($model));
        $url = 'upload/images/' . $type . '/original/' . $name;
        $url100 = 'upload/images/' . $type . '/100/' . $name;
        $url400 = 'upload/images/' . $type . '/400/' . $name;
        $image->save($url);
        $image->resize(150, 150)->save($url100);
        $image->resize(400, 400)->save($url400);

        $image_model = ImageModel::create([
            'name' => $name,
            'description' => $image_type,
            'alt' => $model->title,
            'type' => $type,
            'mime_type' => 'image/png',
            'ext' => 'png',
            'src' => '/' . $url,
            'src100' => '/' . $url100,
            'src400' => '/' . $url400,
            // 'size', save size image
            'width' => $image->width(),
            'height' => $image->height(),
            'user_id' => $model->user_id ? $model->user_id:\Auth::id(),
        ]);
        $model->images()->sync([$image_model->id], false);
    }

    public static function save($file, $model)
    {
        if(!$file){
            return 1;
        }
        $image = Image::make($file);
        $name = rand(10000,99999) . $model->id . '.png';
        $type = strtolower(class_basename($model));
        $url = 'upload/images/' . $type . '/original/' . $name;
        $url100 = 'upload/images/' . $type . '/100/' . $name;
        $url400 = 'upload/images/' . $type . '/400/' . $name;
        $image->save($url);
        $image->resize(150, 150)->save($url100);
        $image->resize(400, 400)->save($url400);

        $image_model = ImageModel::create([
            'name' => $name,
            'description' => 'original',
            'alt' => $model->title,
            'type' => $type,
            'mime_type' => 'image/png',
            'ext' => 'png',
            'src' => '/' . $url,
            'src100' => '/' . $url100,
            'src400' => '/' . $url400,
            // 'size', save size image
            'width' => $image->width(),
            'height' => $image->height(),
            'user_id' => $model->user_id ? $model->user_id:\Auth::id(),
        ]);
        if($type == 'product'){
            $model->images()->sync([$image_model->id], false);
        }else{
            $model->image_id = $image_model->id;
        }
        unset($model->user_id);
        $model->save();
    }

    public static function saveGalleryImage($file)
    {
        if(!$file){
            return 0;
        }
        $image = Image::make($file);
        $name = rand(10000,99999) . '.png';
        // $name = rand(1000,9999) . $model->id . '.png';
        // $type = strtolower(class_basename($model));
        $type = 'product';
        $url = 'upload/images/' . $type . '/original/' . $name;
        $url100 = 'upload/images/' . $type . '/100/' . $name;
        $url400 = 'upload/images/' . $type . '/400/' . $name;
        $image->save($url);
        $image->resize(150, 150)->save($url100);
        $image->resize(400, 400)->save($url400);

        $image_model = ImageModel::create([
            'name' => $name,
            'description' => 'original',
            // 'alt' => $model->title,
            'type' => $type,
            'mime_type' => 'image/png',
            'ext' => 'png',
            'src' => '/' . $url,
            'src100' => '/' . $url100,
            'src400' => '/' . $url400,
            // 'size', save size image
            'width' => $image->width(),
            'height' => $image->height(),
            'user_id' => 1,
        ]);
        return [
            'image_id' => $image_model->id,
            'src' => $image_model->src,
            'url' => $url,
        ];
    }

    public static function uploadfromstring($string,$model,$image_type = 'original')
    {
        $photo_address = 'upload/temp/'.rand(10000,99999).time().'.png';

        // $fi = fopen($photo_address, 'w');
        list($type, $string) = explode(';', $string);
        list(, $string)      = explode(',', $string);
        $string = base64_decode($string);
        file_put_contents($photo_address , $string);

        if($image_type != 'original'){
            self::saveProfile($photo_address, $model, $image_type);
        }
        else{
            self::save($photo_address,$model);
        }
    }


    public static function uploadfromstringForAds($string,$model,$image_type = 'original')
    {
        $photo_address = 'upload/temp/'.rand(10000,99999).time().'.png';

        // $fi = fopen($photo_address, 'w');
        list($type, $string) = explode(';', $string);
        list(, $string)      = explode(',', $string);
        $string = base64_decode($string);
        file_put_contents($photo_address , $string);
            return self::saveGalleryImageAdvertise($photo_address);

    }


    public static function saveGalleryImageAdvertise($file)
    {
        if(!$file){
            return 0;
        }
        $image = Image::make($file);
        $name = rand(10000,99999) . '.png';
        // $name = rand(1000,9999) . $model->id . '.png';
        // $type = strtolower(class_basename($model));
        $type = 'advertise';
        $url = 'upload/images/' . $type . '/original/' . $name;
        $url100 = 'upload/images/' . $type . '/100/' . $name;
        $url400 = 'upload/images/' . $type . '/400/' . $name;
        $image->save($url);
        $image->resize(150, 150)->save($url100);
        $image->resize(400, 400)->save($url400);

        $image_model = ImageModel::create([
            'name' => $name,
            'description' => 'original',
            // 'alt' => $model->title,
            'type' => $type,
            'mime_type' => 'image/png',
            'ext' => 'png',
            'src' => '/' . $url,
            'src100' => '/' . $url100,
            'src400' => '/' . $url400,
            // 'size', save size image
            'width' => $image->width(),
            'height' => $image->height(),
            'user_id' => 1,
        ]);
        return [
            'image_id' => $image_model->id,
            'src' => $image_model->src,
        ];
    }

}
