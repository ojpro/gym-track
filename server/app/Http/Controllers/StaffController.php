<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();

        return response($staff);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStaffRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaffRequest $request)
    {
        $request->validated();

        $request->merge([
            'password' => Hash::make($request['password'])
        ]);

        Staff::create($request->all());

        return response(['success' => 'Staff Created Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $staff = Staff::findOrFail($staff['id']);

        return response($staff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStaffRequest $request
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $staff = Staff::findOrFail($staff['id']);

        $request->validated();

        $request->merge([
            'password' => Hash::make($request['password'])
        ]);

        $staff->update($request->all());

        return response(['success' => 'Staff Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Staff $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff = Staff::findOrFail($staff['id']);

        $staff->delete();

        return response(['success' => 'Staff Deleted Successfully.']);
    }

    /**
     * Get Staff Gym
     * @param Staff $staff
     * @return \Illuminate\Http\Response
     */

    public function gym(Staff $staff)
    {
        $gym = Staff::findOrFail($staff['id'])->gym()->first();
        
        return response($gym);
    }
}
