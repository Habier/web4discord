<?php

namespace Database\Seeders;

use Database\Seeders\dev\DevSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment() == 'local') {
            $this->call([
                DevSeeder::class,
            ]);
        }
    }
}
