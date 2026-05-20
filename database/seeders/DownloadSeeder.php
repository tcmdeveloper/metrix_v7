<?php

namespace Database\Seeders;

use App\Models\Download;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // SEED FROM IMPORT DATABASE

        $model = new Download();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'source' => $item->source,
                'videoId' => $item->videoId,
                'fileName' => $item->fileName,
                'status' => $item->status,
                'error' => $item->error,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at
            ]);
        }
    }
}
