<?php

namespace Database\Seeders\dev;

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RetortSeeder::class,
            PollSeeder::class,
        ]);
    }
}
