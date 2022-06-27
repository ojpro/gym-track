<?php

namespace Tests\Feature\Models;

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
