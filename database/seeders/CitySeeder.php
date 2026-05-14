<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new City();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'state_id' => $item->state_id,      
                'name' => $item->name,      
                'slug' => $item->slug
            ]);
        }
        


        // SEED FROM ARRAY

        // $model = new City();

        // $items = [
        //     [
        //         'hex' => Str::random(11),
        //         'state_id' => 3,
        //         'name' => 'Mesa',
        //         'slug' => Str::slug('Mesa')
        //     ]
        // ];

        // foreach($items as $item){
        //     $model::create($item);
        // }
    }
}
