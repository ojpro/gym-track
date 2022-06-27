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

class SubscriptionTest extends TestCase
{
    /**
     * create new subscription
     */
    public function test_create_subscription()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        Subscription::factory()->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $this->assertDatabaseCount('subscriptions', 1);
    }

    /**
     * get subscriber
     */
    public function test_get_subscriber()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        $subscription = Subscription::factory()->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $subscriber = Subscription::findOrFail($subscription['id'])->with('member')->first();

        $this->assertSame($subscriber['member']['id'], $member['id']);
    }

    /**
     * get subscription's membership
     */
    public function test_get_subscription_membership()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        $subscription = Subscription::factory()->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $subscriptionMembership = Subscription::findOrFail($subscription['id'])->with('membership')->first();

        $this->assertSame($subscriptionMembership['membership']['id'],$membership['id']);
    }
}
