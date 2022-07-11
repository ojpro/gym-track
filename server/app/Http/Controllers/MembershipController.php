<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Membership;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memberships = Membership::all();

        return response($memberships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreMembershipRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipRequest $request)
    {
        $request->validated();

        Membership::create($request->all());

        return response(['success' => 'Membership created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        $membership = Membership::findOrFail($membership['id']);

        return response($membership);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMembershipRequest $request
     * @param \App\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $membership = Membership::findOrFail($membership['id']);

        $request->validated();

        $membership->update($request->all());

        return response(['success' => 'Membership Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        $membership = Membership::findOrFail($membership['id']);

        $membership->delete();

        return response(['success' => 'Membership deleted successfully.']);
    }

    /*
     * get membership's gym
     */

    public function gym(Membership $membership)
    {
        $gym = Membership::findOrFail($membership['id'])->gym()->first();

        return response($gym);
    }

    //TODO: subscriptions & members relationship @tomorrow
}
