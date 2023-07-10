<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $file_path = resource_path('sql/charlie_mqtt_messages.sql');

        \DB::unprepared(
            file_get_contents($file_path)
        );
    }
}
