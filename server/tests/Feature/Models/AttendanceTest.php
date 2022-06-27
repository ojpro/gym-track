<?php

namespace Tests\Feature\Models;

use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    /*
     * create new attendance
     */
    public function test_create_new_attendance()
    {
        $member = Member::factory()->create();

        Attendance::factory()->create([
            'member_id' => $member['id']
        ]);

        $this->assertDatabaseCount('attendances', 1);
    }

    /**
     * get attender
     */
    public function test_get_attender()
    {
        $member = Member::factory()->create();

        $attendance = Attendance::factory()->create([
            'member_id' => $member['id']
        ]);

        $attender = Attendance::findOrFail($attendance['id'])->member()->first();

        $this->assertSame($attender['id'], $member['id']);
    }
}
