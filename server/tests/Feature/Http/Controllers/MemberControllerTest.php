<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberControllerTest extends TestCase
{
    /*
     * validate creation
     */
    public function test_validation()
    {
        $info = [
            'first_name' => 'o'
        ];

        $http_response_header = $this->post(route('member.store'), $info);
        $http_response_header->assertInvalid();
    }

    /*
     * create new member
     */
    public function test_create_member()
    {
        $info = [
            'first_name' => 'Oussama',
            'last_name' => 'ELJabbari',
        ];

        $this->post(route('member.store'), $info);

        $this->assertDatabaseHas('members', $info);
    }

    /*
     * get member info
     */

    public function test_get_member_info()
    {
        $member = Member::factory()->create();

        $http_response_header = $this->get(route('member.show', $member));

        $http_response_header->assertJson($member->toArray());
    }

    /*
     * get all members
     */

    public function test_get_members()
    {
        $members = Member::factory()->count(3)->create();

        $http_response_header = $this->get(route('member.index'));

        $http_response_header->assertJson($members->toArray());
    }

    /*
     * update member info
     */

    public function test_update_member()
    {
        $member = Member::factory()->create();

        $new_info = [
            'email' => 'hany12@gymanko.com'
        ];

        $this->put(route('member.update', $member), $new_info);

        $http_response_header = $this->get(route('member.show', $member));

        $http_response_header->assertJson([
            'email' => 'hany12@gymanko.com'
        ]);
    }

    /*
     * delete a member
     */

    public function test_delete_member()
    {
        $member = Member::factory()->create();

        $this->delete(route('member.destroy', $member));

        $this->assertDatabaseCount('members',0);
    }
}
