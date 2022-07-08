<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Gym;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GymControllerTest extends TestCase
{
    /**
     * Test Create Validation
     *
     * @return void
     */

    public function test_create_validation()
    {
        $gym = [
            'name' => '',
            'owner_id' => 1
        ];

        $http_response_header = $this->post(route('gym.store', $gym));

        $http_response_header->assertInvalid();
    }

    /*
     * Create new Gym
     */

    public function test_create_a_gym()
    {
        $owner = Owner::factory()->create();

        $gym = [
            'name' => 'GoodBoys',
            'owner_id' => $owner['id']
        ];

        $this->post(route('gym.store', $gym));

        $this->assertDatabaseCount('gyms', 1);
    }

    /*
     * Get gym info
     */

    public function test_get_gym_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $http_response_header = $this->get(route('gym.show', $gym));

        $http_response_header->assertJson($gym->toArray());
    }

    /*
     * Get all gym info
     */

    public function test_all_get_gym_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->count(3)->create([
            'owner_id' => $owner['id']
        ]);

        $http_response_header = $this->get(route('gym.index'));

        $http_response_header->assertJson($gym->toArray());
    }

    //TODO: test update validation

    /*
     * Update gym info
     */

    public function test_update_gym_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $new_info = [
            'name' => 'BadBoys'
        ];

        $this->put(route('gym.update', $gym), $new_info);

        $this->assertDatabaseHas('gyms', $new_info);
    }

    /*
    * Get Gym's Owner
    */

    public function test_get_gym_owner()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $http_response_header = $this->get(route('gym.owner', $gym));

        $http_response_header->assertJson($owner->toArray());
    }

    /*
     * Remove a gym
     */

    public function test_remove_gym()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $this->delete(route('gym.destroy', $gym));

        $this->assertDatabaseCount('gyms', 0);
    }


}
