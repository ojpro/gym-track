<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GymTest extends TestCase
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

        $this->assertSame($relation['owner']['id'],$owner['id']);
    }
}
