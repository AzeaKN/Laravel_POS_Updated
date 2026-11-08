<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function test_customer_create_form_validates_and_stores_a_customer(): void
    {
        $this->get(route('customers.create'))->assertOk()->assertSee('Add customer');

        $this->from(route('customers.create'))
            ->post(route('customers.store'), ['full_name' => '', 'email' => 'not-an-email', 'phone' => ''])
            ->assertRedirect(route('customers.create'))
            ->assertSessionHasErrors(['full_name', 'email', 'phone']);

        $this->post(route('customers.store'), [
            'full_name' => 'New Customer',
            'email' => 'new@example.com',
            'phone' => '09171234567',
        ])->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', ['email' => 'new@example.com']);
    }

    public function test_customer_edit_form_updates_a_customer(): void
    {
        $customer = Customer::create([
            'full_name' => 'Old Name',
            'email' => 'old@example.com',
            'phone' => '09000000000',
        ]);

        $this->get(route('customers.edit', $customer))->assertOk()->assertSee('Old Name');
        $this->put(route('customers.update', $customer), [
            'full_name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '09170000000',
        ])->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', ['id' => $customer->id, 'full_name' => 'Updated Name']);
    }

    public function test_user_create_and_edit_workflows_validate_unique_usernames(): void
    {
        $existing = User::create([
            'username' => 'existing',
            'full_name' => 'Existing User',
            'email' => 'existing@example.com',
        ]);

        $this->from(route('users.create'))
            ->post(route('users.store'), [
                'username' => 'existing',
                'full_name' => 'Another User',
                'email' => 'another@example.com',
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('username');

        $this->post(route('users.store'), [
            'username' => 'new-user',
            'full_name' => 'New User',
            'email' => 'new-user@example.com',
        ])->assertRedirect(route('users.index'));

        $this->put(route('users.update', $existing), [
            'username' => 'updated-user',
            'full_name' => 'Updated User',
            'email' => 'updated@example.com',
        ])->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', ['id' => $existing->id, 'username' => 'updated-user']);
    }
}
