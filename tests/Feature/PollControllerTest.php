<?php


namespace Tests\Feature;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Inertia\Testing\AssertableInertia as Assert;

class PollControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_browse(): void
    {
        $user = User::factory()->create();
        $pollQuantity = 30;
        Poll::factory()->count($pollQuantity)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get(route('polls.browse'))->assertStatus(200);

        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Poll/Browse')
            ->where('polls.total', $pollQuantity)
            ->etc()
        );

    }
}
