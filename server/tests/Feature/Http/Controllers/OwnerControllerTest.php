<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Gym;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OwnerControllerTest extends TestCase
{
    /**
     * Test api route
     *
     * @return void
     */
    public function test_check_api_route()
    {
        $response = $this->get(route('owner.store'));

        $response->assertStatus(200);
    }

    /*
     * Test if the validation work when creating an owner
     */
    public function test_validate_owner_creation()
    {
        $owner = [
            'full_name' => 'ali',
            'password' => '12345678'
        ];

        $response = $this->post(route('owner.store'), $owner);

        $response->assertInvalid();
    }

    /*
     * Create owner
     */

    public function test_create_new_owner()
    {
        $owner = [
            'full_name' => 'Ali Mohamed',
            'phone' => '+21260464886',
            'password_confirmation' => 'P@$$W0rD',
            'password' => 'P@$$W0rD'
        ];

        $this->post(route('owner.store'), $owner);

        $this->assertDatabaseCount('owners', 1);
    }

    /*
     * fetch owner information
     */
    public function test_fetch_owner_info()
    {

        $owner = Owner::factory()->create();

        $response = $this->get(route('owner.show', $owner));

        $response->assertExactJson($owner->toArray());
    }

    /*
     * fetch all owners
     */

    public function test_fetch_all_owners()
    {
        $owners = Owner::factory()->count(3)->create();

        $response = $this->get(route('owner.index'));

        $response->assertExactJson($owners->toArray());
    }

    /*
     * Test to update owner information
     */

    public function test_update_owner_info()
    {
        $owner = Owner::factory()->create();

        $new_info = [
            //TODO: email are not being validated despite using request validation
            'email' => 'hey@ojpro.me'
        ];

        $this->put(route('owner.update', $owner), $new_info);

        $response = $this->get(route('owner.show', $owner['id']));

        $response->assertJson($new_info);
    }

    /*
     * Delete an existed owner
     */

    public function test_delete_owner()
    {
        $owner = Owner::factory()->create();

        $response = $this->delete(route('owner.destroy', $owner));

        $this->assertDatabaseCount('owners', 0);
    }

    /*
     * Get Owner's list of gyms
     */
    public function test_get_owner_gyms()
    {
        $owner = Owner::factory()->create();

        $gyms = Gym::factory()->count(3)->create([
            'owner_id' => $owner['id']
        ]);

        $http_response_header = $this->get(route('owner.gyms', $owner));

        $this->assertSameSize($http_response_header['gyms'], $gyms->toArray());
    }
}
