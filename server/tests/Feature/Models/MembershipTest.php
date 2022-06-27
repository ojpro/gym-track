<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Owner;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MembershipTest extends TestCase
{

    /**
     * create a membership
     */

    public function test_create_membership()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        Membership::factory()->create([
            'gym_id' => $gym['id']
        ]);

        $this->assertDatabaseCount('memberships', 1);
    }

    /*
     * get membership's gym
     */
    public function test_get_membership_gym()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $membership = Membership::factory()->create([
            'gym_id' => $gym['id']
        ]);

        $membershipGym = Membership::findOrFail($membership['id'])->with('gym')->first();

        $this->assertSame($membershipGym['gym']['id'], $gym['id']);
    }

    /**
     * get membership subscriptions
     */
    public function test_get_membership_subscriptions()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        Subscription::factory()->count(3)->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $membershipSubscriptions = Membership::findOrFail($membership['id'])
            ->withCount('subscriptions')->first();

        $this->assertSame($membershipSubscriptions['subscriptions_count'], 3);
    }
}
