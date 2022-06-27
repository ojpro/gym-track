<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StaffTest extends TestCase
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

    /*
     * Create a staff
     */
    public function test_create_staff()
    {
        $gym = Gym::factory()->create();

        $staff = Staff::factory()->create([
            'gym_id' => $gym['id']
        ]);

        $this->assertDatabaseCount('staff', 1);
    }

    /**
     * get the staff's gym
     */

    public function test_get_staff_gym()
    {
        $gym = Gym::factory()->create();

        $staff = Staff::factory()->create([
            'gym_id' => $gym['id']
        ]);

        $work_in = Staff::findOrFail($staff['id'])->with('gym')->first();

        $this->assertSame($work_in['gym']['id'], $gym['id']);
    }
}
