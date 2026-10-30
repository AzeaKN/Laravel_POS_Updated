<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_welcome_page_only_lists_today_tasks(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('Tasks for today')
            ->assertSee('Review today’s priorities')
            ->assertDontSee('Prepare the weekly report')
            ->assertDontSee('Plan next week’s tasks');
    }

    public function test_task_list_page_lists_every_task_in_date_order(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk()
            ->assertSee('Task list')
            ->assertSeeInOrder([
                'Prepare the weekly report',
                'Review today’s priorities',
                'Plan next week’s tasks',
                'Back up project files',
            ]);
    }

    public function test_profile_page_shows_the_single_seeded_user(): void
    {
        $this->assertDatabaseCount('users', 1);

        $this->get(route('profile'))
            ->assertOk()
            ->assertSee('chaz1303')
            ->assertSee('Chaz')
            ->assertSee('chaz1303@example.com');
    }

    public function test_seed_contains_eight_tasks_across_multiple_dates(): void
    {
        $this->assertDatabaseCount('tasks', 8);
        $this->assertSame(4, \Illuminate\Support\Facades\DB::table('tasks')->distinct('task_date')->count('task_date'));
    }

    public function test_about_page_identifies_the_developer(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Built by Chaz')
            ->assertSee('Laravel');
    }
}
