<?php

namespace Tests\Feature\Models;

use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class MemberTest extends TestCase
{

    /*
     * Create new member with name only
     */

    public function test_create_member_with_name_only()
    {
        Member::create([
            'uuid' => Str::uuid()->toString(),
            'code' => 2734,
            'first_name' => 'Alex',
            'last_name' => 'Moraine'
        ]);

        $this->assertDatabaseCount('members', 1);
    }

    /**
     * create member
     */
    public function test_create_member()
    {
        Member::factory()->create();

        $this->assertDatabaseCount('members', 1);
    }

    /**
     * get member's attendances
     */
    public function test_get_member_attendances()
    {
        $member = Member::factory()->create();

        Attendance::factory()->count(5)->create([
            'member_id' => $member['id']
        ]);

        $attender = Member::findOrFail($member['id'])->with('attendances')->first();

        $this->assertTrue(count($attender['attendances']) === 5);
    }
}
