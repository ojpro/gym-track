<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Owner;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    /*
     * validate creation
     */
    public function test_validation()
    {
        $info = [
            'status' => 'none'
        ];

        $http_response_header = $this->post(route('subscription.store'), $info);

        $http_response_header->assertInvalid();
    }

    /*
     * create new subscription
     */
    public function test_create_subscription()
    {
        $owner = Owner::factory()->create();
        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);
        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);
        $member = Member::factory()->create();

        $info = [
            'member_id' => $member['id'],
            'membership_id' => $membership['id'],
            'started_at' => Carbon::now()->toDateTimeLocalString(),
            'expire_at' => Carbon::now()->addMonth()->toDateTimeLocalString()

        ];

        $this->post(route('subscription.store'), $info);

        $this->assertDatabaseHas('subscriptions', $info);
    }

    /*
     * get subscription info
     */

    public function test_get_subscription_info()
    {
        $owner = Owner::factory()->create();
        $gym = Gym::factory()->create(['owner_id' => $owner]);
        $membership = Membership::factory()->create(['gym_id' => $gym]);
        $member = Member::factory()->create();

        $subscription = Subscription::factory()->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $http_response_header = $this->get(route('subscription.show', $subscription));

        $http_response_header->assertJson($subscription->toArray());
    }

    /*
     * get all subscriptions
     */

    public function test_get_subscriptions()
    {
        $owner = Owner::factory()->create();
        $gym = Gym::factory()->create(['owner_id' => $owner]);
        $membership = Membership::factory()->create(['gym_id' => $gym]);
        $member = Member::factory()->create();

        $subscriptions = Subscription::factory()->count(3)->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);
        $http_response_header = $this->get(route('subscription.index'));

        $http_response_header->assertJson($subscriptions->toArray());
    }

    /*
     * update subscription info
     */

    public function test_update_subscription()
    {
        $owner = Owner::factory()->create();
        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);
        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);
        $member = Member::factory()->create();

        $subscription = Subscription::factory()->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $new_info = [
            'status' => 'pending',
            'expire_at' => Carbon::now()->addMonths(3)->toDateTimeLocalString()
        ];

        $this->put(route('subscription.update', $subscription), $new_info);

        $http_response_header = $this->get(route('subscription.show', $subscription));

        $http_response_header->assertJson($new_info);
    }

    /*
     * delete a subscription
     */

    public function test_delete_subscription()
    {
        $owner = Owner::factory()->create();
        $gym = Gym::factory()->create(['owner_id' => $owner['id']]);
        $membership = Membership::factory()->create(['gym_id' => $gym['id']]);
        $member = Member::factory()->create();

        $subscription = Subscription::factory()->create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id']
        ]);

        $this->delete(route('subscription.destroy', $subscription));

        $this->assertDatabaseCount('subscriptions', 0);
    }

}
