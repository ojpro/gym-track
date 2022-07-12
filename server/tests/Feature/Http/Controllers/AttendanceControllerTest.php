<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttendanceControllerTest extends TestCase
{
    /*
     * validate creation
     */
    public function test_validation_when_creating_new_attendance()
    {
        $data = [
            'attend_at' => 'today',
            'member_id' => 1
        ];

        $http_response_header = $this->post(route('attendance.store'), $data);

        $http_response_header->assertInvalid();
    }

    /*
    * create new attendance
    */
    public function test_create_new_attendance()
    {
        $member = Member::factory()->create();

        $data = [
            'attend_at' => Carbon::now()->toDateTimeLocalString(),
            'member_id' => $member['id']
        ];

        $this->post(route('attendance.store'), $data);

        $this->assertDatabaseHas('attendances', $data);
    }

    /*
    * get attendance info
    */
    public function test_get_attendance_info()
    {
        $member = Member::factory()->create();

        $attendance = Attendance::factory()->create([
            'member_id' => $member['id']
        ]);

        $http_response_header = $this->get(route('attendance.show', $attendance));

        $http_response_header->assertJson([
            'member_id' => $member['id']
        ]);
    }

    /*
     * get list of all attendances
     */
    public function test_get_list_of_all_attendances()
    {
        $member = Member::factory()->create();
        $attendances = Attendance::factory()->count(3)->create([
            'member_id' => $member['id']
        ]);

        $http_response_header = $this->get(route('attendance.index'));

        $http_response_header->assertJson($attendances->toArray());
    }

    /*
     * update attendance
     */
    public function test_update_attendance(){
        $member = Member::factory()->create();
        $attendance = Attendance::factory()->create([
            'member_id' => $member['id']
        ]);

        $data = [
            'attend_at'=>Carbon::now()->addMonths(3)->toDateTimeLocalString()
        ];

        $this->put(route('attendance.update',$attendance),$data);

        $this->assertDatabaseHas('attendances',$data);
    }

    /*
     * delete an attendance
     */

    public function test_delete_an_attendance(){
        $member = Member::factory()->create();
        $attendance = Attendance::factory()->create([
            'member_id' => $member['id']
        ]);

        $this->delete(route('attendance.destroy',$attendance));

        $this->assertDatabaseCount('attendances',0);
    }
}
