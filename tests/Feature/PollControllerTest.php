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
        $this->actingAs($user = User::factory()->create());

        $pollQuantity = 30;
        Poll::factory()->count($pollQuantity)->create(['user_id' => $user->id]);


        $response = $this->get(route('polls.index'))->assertStatus(200);

        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Poll/Index')
            ->where('polls.total', $pollQuantity)
            ->etc()
        );

    }

    public function test_read_poll()
    {
        $this->actingAs($user = User::factory()->create());

        $poll = Poll::factory()->hasOptions(4)->create(['user_id' => $user->id]);

        //Check if page loaded without problems
        $response = $this->get(route('polls.show', $poll))->assertStatus(200);

        //check if values are passed correctly
        $response->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Poll/Show')
            ->where('poll.id', $poll->id)
            ->has('poll.options', 4)
            ->etc()
        );
    }

    public function test_send_vote()
    {
        $this->actingAs($user = User::factory()->create());

        $poll = Poll::factory()->hasOptions(4)->create(['user_id' => $user->id]);

        //Check if properly redirected
        $this->post(route('polls.vote', $poll), ['option' => $poll->options->first()->id])
            ->assertRedirect(route('polls.show', $poll));

        //check if the vote is registered
        $this->assertDatabaseCount('poll_votes', 1);
    }

    public function test_add_poll()
    {
        $this->markTestSkipped('TODO');
    }

    public function test_delete_poll()
    {
        $this->markTestSkipped('TODO');
    }


}
