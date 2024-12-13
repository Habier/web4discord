<?php

namespace Database\Seeders\dev;

use App\Models\Poll;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poll::factory()->count(30)->create(['user_id' => 1]);
    }
}
