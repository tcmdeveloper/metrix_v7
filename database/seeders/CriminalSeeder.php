<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Criminal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CriminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new Criminal();
        
        $items = $model::on('mysql_import')->get();

        

        foreach($items as $item){
       
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'user_id' => $item->user_id,
                'criminal_case_id' => $item->criminal_case_id,
                'first_name' => $item->first_name,
                'middle_name' => $item->middle_name,
                'last_name' => $item->last_name,
                'slug' => $item->slug,
                'description' => $item->description,
                'personal_summary' => $item->personal_summary,
                'date_of_birth' => $item->date_of_birth,
                'year_of_birth' => $item->year_of_birth,
                'gender' => $item->gender,
                'star_sign' => $item->star_sign,
                'criminal_status' => $item->criminal_status,
                'arrest_date' => $item->arrest_date,
                'conviction_date' => $item->conviction_date,
                'sentence' => $item->sentence,
                'main_image_id' => $item->main_image_id,
                'views' => $item->views,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'status' => $item->status
            ]);
            
        }
    }
}
