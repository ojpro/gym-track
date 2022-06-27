<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Owner;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StaffTest extends TestCase
{

    /*
     * Create a staff
     */
    public function test_create_staff()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

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
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $staff = Staff::factory()->create([
            'gym_id' => $gym['id']
        ]);

        $work_in = Staff::findOrFail($staff['id'])->with('gym')->first();

        $this->assertSame($work_in['gym']['id'], $gym['id']);
    }
}
