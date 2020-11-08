<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Laravel\Jetstream\RedirectsActions;
use Tests\TestCase;

class RegisterModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function automatically_make_a_profile_when_a_user_registers()
    {
        Event::fake();
        $this->withExceptionHandling();

        $response = $this->post(route('register'), [
            'name' => 'test user',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        Event::assertDispatched(Registered::class);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $this->assertDatabaseCount('profiles', 1);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function user_is_redirected_to_appropriate_route_after_registering()
    {
        $response = $this->post(route('register'), [
            'name' => 'test user',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
