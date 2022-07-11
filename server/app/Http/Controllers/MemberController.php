<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();

        return response($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreMemberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $request->validated();

        $request->merge([
            'uuid' => Str::uuid()->toString(),
            'code' => random_int(1000, 10000),
            'password' => Hash::make($request['password'])
        ]);

        Member::create($request->all());

        return response(['success' => 'Member Created Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $member = Member::findOrFail($member['id']);

        return response($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMemberRequest $request
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member = Member::findOrFail($member['id']);

        $request->validated();

        $request->merge([
            'password' => Hash::make($request['password'])
        ]);

        $member->update($request->all());

        return response(['success' => 'Member Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member = Member::findOrFail($member['id']);

        $member->delete();

        return response($member);
    }
}
