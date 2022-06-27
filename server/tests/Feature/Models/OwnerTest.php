<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OwnerTest extends TestCase
{

    /**
     * Create new Owner
     */
    public function test_create_owner()
    {
        Owner::factory()->create();

        $this->assertDatabaseCount('owners', 1);
    }

    /**
     * List Owned GYMs
     */
    public function test_list_owned_gyms()
    {
        $owner = Owner::factory()->create();

        Gym::factory()->count(3)->create([
            'owner_id' => $owner['id']
        ]);

        $owned = Owner::findOrFail($owner['id'])->withCount('gyms')->first();

        // TODO: improve assertion
        $this->assertTrue($owned['gyms_count'] === 3);

    }
}
