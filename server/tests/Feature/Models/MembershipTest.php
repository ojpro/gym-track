<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Membership;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MembershipTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * create a membership
     */

    public function test_create_membership()
    {
        $gym = Gym::factory()->create();

        $membership = Membership::factory()->create([
            'gym_id' => $gym['id']
        ]);

        $this->assertDatabaseCount('memberships', 1);
    }

    /*
     * get membership's gym
     */
    public function test_get_membership_gym()
    {
        $gym = Gym::factory()->create();

        $membership = Membership::factory()->create([
            'gym_id' => $gym['id']
        ]);

        $membershipGym = Membership::findOrFail($membership['id'])->with('gym')->first();

        $this->assertSame($membershipGym['gym']['id'], $gym['id']);
    }
}
