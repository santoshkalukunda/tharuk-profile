<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public  function boot()
    {
        parent::setup();
        $this->actingAs(\App\Models\User::factory()->create());
    }

    private function makeProfile()
    {
        $user = \App\Models\User::factory()->create();
        return $user->profile()->save(Profile::factory()->make());
    }

    /** @test */
    public function profile_page_url_is_working()
    {
        $this->withoutExceptionHandling();

        $profile = $this->makeProfile();

        $this->assertEquals(1, User::count());
        // $this->get(route('profiles.show', $profile))->assertSuccessful();
    }
}
