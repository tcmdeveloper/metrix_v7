<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DELETE ALL TABLES IN DB
        // Artisan::call('migrate:reset', ['--force' => true]);
        
        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class,
            AppSettingSeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            CountySeeder::class,
            ImageSeeder::class,
            CategorySeeder::class,
            CriminalCaseSeeder::class,
            CriminalSeeder::class,
            JudgeSeeder::class,
            LawyerSeeder::class,
            ArticleSeeder::class,
            VictimSeeder::class,
            DownloadSeeder::class,
            EmailChangeRequestSeeder::class,
        ]);
    }
}
