<?php


namespace Tests\Feature;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;

class PollControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_browse_poll(): void
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

    public function test_read_poll()
    {
        $this->markTestSkipped('TODDO');
    }

    public function test_add_poll()
    {
        $this->markTestSkipped('TODDO');
    }

    public function test_delete_poll()
    {
        $this->markTestSkipped('TODDO');
    }


}
