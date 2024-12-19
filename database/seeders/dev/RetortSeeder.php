<?php

namespace Database\Seeders\dev;

use App\Models\Retort;
use Illuminate\Database\Seeder;

class RetortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Retort::factory()->count(7)->create();
    }
}
