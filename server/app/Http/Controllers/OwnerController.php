<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::all();

        return response($owners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreOwnerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOwnerRequest $request)
    {
        $request->validated();

        $hashed_password = Hash::make($request['password']);

        // Hash the password in the request
        $request->merge([
            'password' => $hashed_password
        ]);

        Owner::create($request->all());

        return response(['success' => 'Owner Added Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        $owner = Owner::findOrFail($owner['id']);

        return response($owner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateOwnerRequest $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        $owner = Owner::findOrFail($owner['id']);

        $request->validated();

        $hashed_password = Hash::make($request['password']);

        // Hash the password in the request
        $request->merge([
            'password' => $hashed_password
        ]);

        $owner->update($request->all());

        return response(['success' => 'Owner Information Updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        $owner = Owner::findOrFail($owner['id']);

        $owner->delete();

        return response(['success' => 'Owner Deleted Successfully.']);
    }
}
