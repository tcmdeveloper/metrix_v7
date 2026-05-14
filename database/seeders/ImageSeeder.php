<?php

namespace Database\Seeders;

use App\Models\ImageSmash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new ImageSmash();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,	
                'user_id' => $item->user_id,	
                'resource_model' => $item->resource_model,	
                'resource_id' => $item->resource_id,	
                'filename' => $item->filename,
                'bg_position' => $item->bg_position,	
                'caption' => $item->caption,	
                'copyright' => $item->copyright,	
                'copyright_link' => $item->copyright_link,
                'created_at' => $item->created_at,	
                'updated_at' => $item->updated_at,	
                'status' => $item->status,
            ]);
        }
    }
}
