<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_account_management_routes(): void
    {
        $this->get(route('customers.index'))->assertRedirect(route('login'));
        $this->get(route('users.index'))->assertRedirect(route('login'));
        $this->get(route('customers.create'))->assertRedirect(route('login'));
        $this->get(route('users.create'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_account_management_routes(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('customers.index'))->assertOk();
        $this->get(route('users.index'))->assertOk();
    }
}
