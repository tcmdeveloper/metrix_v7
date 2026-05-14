<?php

namespace Database\Seeders;

use App\Models\Judge;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JudgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // SEED FROM IMPORT DATABASE

        $model = new Judge();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'user_id' => $item->user_id,
                'criminal_case_id' => $item->criminal_case_id,
                'title' => $item->title,
                'first_name' => $item->first_name,
                'middle_name' => $item->middle_name,
                'slug' => $item->slug,
                'last_name' => $item->last_name,
                'bio' => $item->bio,
                'gender' => $item->gender,
                'appointed' => $item->appointed,
                'retired' => $item->retired,
                'court' => $item->court,
                'county_id' => $item->county_id,
                'state_id' => $item->state_id,
                'main_image_id' => $item->main_image_id,
                'views' => $item->views,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'status' => $item->status
            ]);
        }

    }
}
