<?php

namespace Tests\Feature;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

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
        $this->get(route('profiles.show', $profile->id))->assertSuccessful();
    }
}
