<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Member;
use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class MemberTest extends TestCase
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
     * Create new member with name only
     */

    public function test_create_member_with_name_only()
    {
        $member = Member::create([
            'uuid' => Str::uuid()->toString(),
            'code'=>2734,
            'first_name' => 'Alex',
            'last_name' => 'Moraine'
        ]);

       $this->assertDatabaseCount('members',1);
    }

    /**
     * create member
     */
    public function test_create_member(){
        Member::factory()->create();

        $this->assertDatabaseCount('members',1);
    }
}
