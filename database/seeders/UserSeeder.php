<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new User();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'email_verified_at' => $item->email_verified_at,
                'password' => $item->password,
                'user_type_id' => $item->user_type_id,
                'image' => $item->image,
                'remember_token' => $item->remember_token,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at
            ]);
        }
        


        // SEED FROM ARRAY

        // $model = new User();

        // $items = [
        //     [
        //         'hex' => Str::random(11),
        //         'first_name' => 'Frank',
        //         'last_name' => 'Jones',
        //         'email' => 'frankjones.web@gmail.com',
        //         'email_verified_at' => time(),
        //         'password' => bcrypt('asasasas'),
        //         'user_type_id' => 4,
        //         'image' => null,
        //         'remember_token' => Str::random(10),
        //         'created_at' => time(),
        //         'updated_at' => time()
        //     ]
        // ];

        // foreach($items as $item){
        //     $model::create($item);
        // }
    }
}
