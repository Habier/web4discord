<?php

namespace Tests\Feature;

use App\Models\Retort;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RetortControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function it_browses_user_retorts()
    {
        $user = User::factory()->create();
        Retort::factory()->for($user)->count(3)->create();

        $response = $this->actingAs($user)->get(route('retorts.index'));

        $response
            ->assertOk()
            ->assertInertia(fn($page) => $page->component('Retort/Main')
                ->has('retorts', 3)
            );
    }

    #[Test] public function it_adds_a_new_retort()
    {
        $user = User::factory()->create();
        $data = [
            'question' => 'What is the meaning of life?',
        ];

        $response = $this->actingAs($user)->post(route('retorts.store'), $data);

        $response->assertRedirect(route('retorts.index'));
        $this->assertDatabaseHas('retorts', [
            'user_id' => $user->id,
            'question' => $data['question'],
        ]);
    }

    #[Test] public function it_deletes_a_retort()
    {
        $user = User::factory()->create();
        $retort = Retort::factory()->for($user)->create();

        $response = $this->actingAs($user)->delete(route('retorts.destroy', $retort));

        $response->assertRedirect(route('retorts.index'));
        $this->assertDatabaseMissing('retorts', ['id' => $retort->id]);
    }

    #[Test] public function it_downloads_retorts_as_a_text_file()
    {
        $user = User::factory()->create();
        $retorts = Retort::factory()->count(5)->create();

        $response = $this->actingAs($user)->get(route('retorts.download'));

        $response->assertOk();
        $this->assertStringContainsString($retorts->first()->question, $response->content());
    }
}
