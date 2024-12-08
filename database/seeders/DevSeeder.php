<?php

namespace Database\Seeders;

use App\Models\Retort;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);
    }
}
