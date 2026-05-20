<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        User::unguarded(function () {

            $items = User::on('mysql_import')->get();

            foreach ($items as $item) {

                User::create([
                    'id' => $item->id,
                    'hex' => $item->hex,
                    'email' => $item->email,
                    'email_verified_at' => $item->email_verified_at,
                    'password' => $item->password,
                    'google_id' => $item->google_id,
                    'remember_token' => $item->remember_token,
                    'role' => $item->role,
                    'username' => $item->username,
                    'first_name' => $item->first_name,
                    'last_name' => $item->last_name,
                    'avatar' => $item->avatar,
                    'country_code' => $item->country_code,
                    'state_code' => $item->state_code,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);

            }

        });

        
    }
}
