<?php

namespace Tests\Feature\Models;

use App\Models\Attendance;
use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Owner;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class MemberTest extends TestCase
{

    /*
     * Create new member with name only
     */

    public function test_create_member_with_name_only()
    {
        Member::create([
            'uuid' => Str::uuid()->toString(),
            'code' => 2734,
            'first_name' => 'Alex',
            'last_name' => 'Moraine'
        ]);

        $this->assertDatabaseCount('members', 1);
    }

    /**
     * create member
     */
    public function test_create_member()
    {
        Member::factory()->create();

        $this->assertDatabaseCount('members', 1);
    }

    /**
     * get member's attendances
     */
    public function test_get_member_attendances()
    {
        $member = Member::factory()->create();

        Attendance::factory()->count(5)->create([
            'member_id' => $member['id']
        ]);

        $attender = Member::findOrFail($member['id'])->withCount('attendances')->first();

        $this->assertTrue($attender['attendances_count'] === 5);
    }

    /**
     * get member subscriptions
     */

    public function test_get_member_subscriptions()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        Subscription::factory()->count(4)->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $subscriber = Member::findOrFail($member['id'])->withCount('subscriptions')->first();

        $this->assertTrue($subscriber['subscriptions_count'] === 4);
    }

    /**
     * get latest subscription
     */
    public function test_get_latest_subscription()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        $subscriptions = Subscription::factory()->count(4)->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $latestSubscription = Member::findOrFail($member['id'])->latestSubscription()->first();

        $this->assertSame($latestSubscription['id'], $subscriptions[3]['id']);
    }

    /**
     * get current subscription
     */

    public function test_get_current_subscription()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);

        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);

        $member = Member::factory()->create();

        Subscription::factory()->count(10)->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $currentSubscription = Member::findOrFail($member['id'])->currentSubscription()->first();

        $this->assertSame($currentSubscription['status'], 'current');
    }
}
