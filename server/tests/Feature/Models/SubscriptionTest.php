<?php

namespace Tests\Feature\Models;

use App\Models\Attendance;
use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Owner;
use App\Models\Subscription;
use Carbon\Carbon;
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

        $subscriber = Subscription::findOrFail($subscription['id'])->member()->first();

        $this->assertSame($subscriber['id'], $member['id']);
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

        $subscriptionMembership = Subscription::findOrFail($subscription['id'])->membership()->first();

        $this->assertSame($subscriptionMembership['id'],$membership['id']);
    }

    //TODO: learn how to write good test (that can improve performance).

    /*
     * get subscription attendances
     */

    public function test_get_subscription_attendances(){
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        $subscription = Subscription::factory()->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        Attendance::factory()->count(2)->create([
            'member_id' => $member['id']
        ]);

        $attendances = Attendance::factory()->count(2)->create([
            'member_id' => $member['id'],
            'attend_at'=>Carbon::create($subscription['started_at'])->addDays(rand(1,20))
        ]);

        Attendance::factory()->count(2)->create([
            'member_id' => $member['id'],
            'attend_at'=>Carbon::create($subscription['expire_at'])->addDays(rand(1,20))
        ]);

        $subscriptionAttendances = Subscription::findOrFail($subscription['id'])->attendances()->first();

        $this->assertSame(count($attendances),$subscriptionAttendances['attendances']->count());
    }
}
