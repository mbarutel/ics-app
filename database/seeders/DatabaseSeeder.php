<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'mike',
            'last_name' => 'edubas',
            'email' => 'mike@local',
            'password' => Hash::make('secret1234'),
            'is_admin' => 1
        ]);

        DB::table('events')->insert([
            'id' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'slug' => 'test-event',
            'title' => 'Test Event',
            'status' => 'draft',
            'description' => 'Hello, this is a test event',
            'start_date' => '2025-03-08T17:33',
            'end_date' => '2025-03-18T15:34',
            'venue' => 'Hilton Hotel, Gold Coast',
            'published_id' => null
        ]);
    }
}
