<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new UserType();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'name' => $item->name  
            ]);
        }
        


        // SEED FROM ARRAY

        // $model = new UserType();

        // $items = [
        //     [
        //         'hex' => Str::random(11),
        //         'name' => 'Registered'
        //     ],
        //     [
        //         'hex' => Str::random(11),
        //         'name' => 'Author'
        //     ],
        //     [
        //         'hex' => Str::random(11),
        //         'name' => 'Publisher'
        //     ],
        //     [
        //         'hex' => Str::random(11),
        //         'name' => 'Admin'
        //     ],
        //     [
        //         'hex' => Str::random(11),
        //         'name' => 'Super Admin'
        //     ],
        // ];

        // foreach($items as $item){
        //     $model::create($item);
        // }
    }
}
