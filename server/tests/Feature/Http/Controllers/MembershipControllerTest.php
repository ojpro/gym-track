<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Gym;
use App\Models\Membership;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MembershipControllerTest extends TestCase
{

    /*
     * validate creation
     */

    public function test_validation()
    {
        $data = [
            'nothing'
        ];

        $http_response_header = $this->post(route('membership.store'), $data);

        $http_response_header->assertInvalid();
    }

    /*
     * create new membership
     */

    public function test_create_new_membership()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $membership = [
            'name' => 'Starter',
            'attendances' => 3,
            'price' => 70,
            'gym_id' => $gym['id']
        ];

        $this->post(route('membership.store'), $membership);

        $this->assertDatabaseHas('memberships', $membership);
    }

    /*
     * get membership info
     */
    public function test_get_membership_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $membership = Membership::factory()->create([
            'gym_id' => $gym
        ]);

        $http_response_header = $this->get(route('membership.show', $membership));

        $http_response_header->assertSimilarJson($membership->toArray());
    }

    /*
     * get all memberships
     */
    public function test_get_all_memberships_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $membership = Membership::factory()->count(3)->create([
            'gym_id' => $gym
        ]);

        $http_response_header = $this->get(route('membership.index'));

        $http_response_header->assertSimilarJson($membership->toArray());
    }

    /*
     * update membership info
     */
    public function test_update_membership_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $membership = Membership::factory()->create([
            'gym_id' => $gym
        ]);

        $this->put(route('membership.update', $membership), [
            'price' => 90
        ]);

        $this->assertDatabaseHas('memberships', [
            'price' => 90
        ]);
    }

    /*
     * delete membership
     */

    public function test_delete_membership()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $membership = Membership::factory()->create([
            'gym_id' => $gym
        ]);

        $this->delete(route('membership.destroy',$membership));

        $this->assertDatabaseCount('memberships',0);
    }

    /*
     * get membership gym
     */

    public function test_get_membership_gym(){
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $membership = Membership::factory()->create([
            'gym_id' => $gym
        ]);

        $http_response_header = $this->get(route('membership.gym',$membership));

        $http_response_header->assertSimilarJson($gym->toArray());
    }
}
