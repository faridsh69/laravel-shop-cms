<?php

use Illuminate\Database\Seeder;
use \App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
            	'id' => 1,
            	'name' => 'default.png',
        		'description' => 'test',
        		'alt' => 'defaul picture',
        		'type' => 'original',
        		'mime_type' => 'image/png',
        		'ext' => 'png',
                'src' => '/upload/images/default.png',
                'src100' => '/upload/images/default.png',
        		'src400' => '/upload/images/default.png',
        		'size' => '100',
        		'width' => '150',
        		'height' => '150',
            ],
            [
                'id' => 2,
                'name' => 'default.png',
                'description' => 'test',
                'alt' => 'default picture',
                'type' => 'original',
                'mime_type' => 'image/png',
                'ext' => 'png',
                'src' => '/upload/images/baner1.png',
                'src100' => '/upload/images/baner1.png',
                'src400' => '/upload/images/baner1.png',
            ],
            [
                'id' => 3,
                'name' => 'default.png',
                'description' => 'test',
                'alt' => 'default picture',
                'type' => 'original',
                'mime_type' => 'image/png',
                'ext' => 'png',
                'src' => '/upload/images/baner2.png',
                'src100' => '/upload/images/baner2.png',
                'src400' => '/upload/images/baner2.png',
            ],
            [
                'id' => 4,
                'name' => 'default.png',
                'description' => 'test',
                'alt' => 'default picture',
                'type' => 'original',
                'mime_type' => 'image/png',
                'ext' => 'png',
                'src' => '/upload/images/baner3.png',
                'src100' => '/upload/images/baner3.png',
                'src400' => '/upload/images/baner3.png',
            ]
    	];
        foreach($images as $image)
        {
            $image['user_id'] = 1;
            Image::updateOrCreate( ['id' => $image['id']],$image);
        }
    }
}

