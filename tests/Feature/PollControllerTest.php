<?php


namespace Tests\Feature;

use App\Models\Poll;
use App\Models\PollOption;
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

    public function test_load_create()
    {
        $this->actingAs($user = User::factory()->create());
        $response = $this->get(route('polls.create'))->assertStatus(200);

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

        $optionId = $poll->options->first()->id;

        //Check if properly redirected
        $this->post(route('polls.vote', $poll), ['option' => $optionId])
            ->assertRedirectToRoute('polls.show', $poll)
            ->assertSessionHasNoErrors();

        //check if the vote is registered
        $this->assertDatabaseCount('votes', 1);

        //check that voting twice is impossible
        $this->post(route('polls.vote', $poll->id), ['option' => $optionId])
            ->assertSessionHasErrors(['vote']);

        $this->assertDatabaseHas('poll_options', [
            'id' => $optionId,
            'count' => 1
        ]);

    }

    public function test_add_poll()
    {
        $this->actingAs($user = User::factory()->create());
        $data = Poll::factory()->make(['user_id' => $user->id])->toArray();
        $data['options'] = PollOption::factory()->count(4)->make()->pluck('title')->toArray();
        $this->post(route('polls.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('polls.index'));

        $this->assertDatabaseCount('polls', 1);
        $this->assertDatabaseCount('poll_options', 4);
    }

    public function test_delete_poll()
    {
        $originalUser = User::factory()->create();
        $this->actingAs($user = User::factory()->create());

        //Check that only the author can delete de the poll
        $poll = Poll::factory()->hasOptions(4)->create(['user_id' => $originalUser->id]);
        $this->delete(route('polls.destroy', $poll))
            ->assertStatus(403);

        $poll = Poll::factory()->hasOptions(4)->create(['user_id' => $user->id]);
        $this->delete(route('polls.destroy', $poll))
            ->assertRedirect(route('polls.index'));
    }


}
