<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Gym;
use App\Models\Owner;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StaffControllerTest extends TestCase
{
    /*
     * Validate Staff Creation
     */
    public function test_validated_staff_creation()
    {
        $staff = [
            'first_name' => 'Om',
            'last_name' => 'ar',
            'email' => 'omar@com'
        ];

        $http_response_header = $this->post(route('staff.store'), $staff);

        $http_response_header->assertInvalid();
    }

    /*
     * Create new staff
     */
    public function test_create_staff()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $staff = [
            'first_name' => 'Ali',
            'last_name' => 'Mihraz',
            'email' => 'alimihra@gmail.com',
            'password' => 'password123',
            'gym_id' => $gym['id']
        ];

        $this->post(route('staff.store'), $staff);

        $this->assertDatabaseCount('staff', 1);
    }

    /*
     * Check if the password is hashed
     */

    public function test_password_hashed()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $staff = [
            "first_name" => "Naomie",
            "last_name" => "Wisoky",
            "phone" => "+1.530.994.8423",
            "username" => "herzog.emelia",
            "email" => "connelly.monica@example.org",
            'password' => '1234qwerty',
            'gym_id' => $gym['id']
        ];

        $this->post(route('staff.store'), $staff);

        $password = Staff::where('email','LIKE',$staff['email'])->firstOrFail()['password'];

        $this->assertTrue(Hash::check($staff['password'], $password));
    }

    /*
     * Get staff info
     */

    public function test_get_staff_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $info = [
            'first_name' => 'Ali',
            'last_name' => 'Mihraz',
            'email' => 'alimihra@gmail.com',
            'gym_id' => $gym['id']
        ];

        $staff = Staff::factory()->create($info);

        $http_response_header = $this->get(route('staff.show', $staff));

        $http_response_header->assertJson($info);
    }

    /*
     * show all staff
     */

    public function test_fetch_all_staff_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $staff = Staff::factory()->count(3)->create([
            'gym_id' => $gym
        ]);

        $http_response_header = $this->get(route('staff.index'));

        $http_response_header->assertJsonCount(count($staff));
    }

    /*
     * Update staff info
     */
    public function test_update_staff_info()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $staff = Staff::factory()->create([
            'gym_id' => $gym
        ]);

        $new_email = [
            'email' => 'contact@mail.me'
        ];

        $this->put(route('staff.update', $staff), $new_email);

        $this->assertDatabaseHas('staff', $new_email);
    }

    /*
     * Delete a staff
     */
    public function test_delete_staff()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $staff = Staff::factory()->create([
            'gym_id' => $gym
        ]);

      $http_response_header =  $this->delete(route('staff.destroy', $staff));

        $this->assertDatabaseCount('staff', 0);
    }

    /**
     * Get Staff Gym
     */
    public function test_get_staff_gym()
    {

        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner
        ]);

        $staff = Staff::factory()->create([
            'gym_id'=>$gym
        ]);

        $http_response_header = $this->get(route('staff.gym', $staff));

        $http_response_header->assertJson($gym->toArray());
    }
}
