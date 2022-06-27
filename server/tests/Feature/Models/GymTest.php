<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Membership;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GymTest extends TestCase
{

    /**
     * Get the gym's owner
     */
    public function test_get_gym_owner()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        $relation = Gym::findOrFail($gym['id'])->with('owner')->first();

        $this->assertSame($relation['owner']['id'], $owner['id']);
    }

    /*
     * get gym's memberships
     */
    public function test_get_gym_memberships()
    {
        $owner = Owner::factory()->create();

        $gym = Gym::factory()->create([
            'owner_id' => $owner['id']
        ]);

        Membership::factory()
            ->count(2)
            ->create([
                'gym_id' => $gym['id']
            ]);

        $gymMemberships = Gym::findOrFail($gym['id'])->with('memberships')->first();

        $this->assertTrue(count($gymMemberships['memberships']) === 2);
    }
}
