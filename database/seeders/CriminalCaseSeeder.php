<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\CriminalCase;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CriminalCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new CriminalCase();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'user_id' => $item->user_id,
                'category_id' => $item->category_id,
                'title' => $item->title,
                'slug' => $item->slug,
                'short_name' => $item->short_name,
                'caption' => $item->caption,
                'description' => $item->description,
                'views' => $item->views,      
                'state_id' => $item->state_id,      
                'city_id' => $item->city_id,      
                'main_image_id' => $item->main_image_id,
                'views' => $item->views,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'status' => $item->status
            ]);
        }
        


        // SEED FROM ARRAY

        // $model = new CriminalCase();

        // $items = [
        //     [
        //         'hex' => Str::random(11),
        //         'user_id' => '1',
        //         'title' => 'The case of Jodi Arias',
        //         'slug' => 'th-case-of-jodi-arias',
        //         'caption' => 'The salacious saga of a bonified psychopath\'s obsession that led to one of the nost famous murders in American history. ',
        //         'description' => 'Some longer description here',
        //         'image' => '',
        //         'image_caption' => '',
        //         'image_copyright' => '',
        //         'image_copyright_link' => '',
        //         'state_id' => '3',
        //         'city_id' => '1',
        //         'status' => 'public',

        //     ]
        // ];

        // foreach($items as $item){
        //     $model::create($item);
        // }
    }
}
