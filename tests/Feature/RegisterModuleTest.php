<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Laravel\Jetstream\RedirectsActions;
use Tests\TestCase;

class RegisterModuleTest extends TestCase
{
    use RefreshDatabase;

    protected function newUser()
    {
        return  [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => now()->subYear(15),
            'gender' => 'male'
        ];
    }

    /** @test */
    public function all_values_are_saved_to_database()
    {
        $this->post(route('register'), $this->newUser());

        $this->assertDatabaseHas('users',  [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'dob' => now()->subYear(15),
            'gender' => 'male'
        ]);
    }

    /** @test */
    public function automatically_make_a_profile_when_a_user_registers()
    {
        $this->withOutExceptionHandling();
        Event::fake([
            Registered::class
        ]);

        $response = $this->post(route('register'), $this->newUser());

        Event::assertDispatched(Registered::class);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $this->assertDatabaseCount('profiles', 1);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function user_is_redirected_to_appropriate_route_after_registering()
    {
        $this->withExceptionHandling();
        $response = $this->post(route('register'), $this->newUser());

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
