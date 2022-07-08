<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use App\Models\Gym;
use Illuminate\Http\Response;

class GymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gyms = Gym::all();

        return response($gyms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreGymRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGymRequest $request)
    {
        $request->validated();

        $gyms = Gym::create($request->all());

        return response(['success' => 'Gym Created Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function show(Gym $gym)
    {
        $gym = Gym::findOrFail($gym['id']);

        return response($gym);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateGymRequest $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGymRequest $request, Gym $gym)
    {
        $gym = Gym::findOrFail($gym['id']);

        $request->validated();

        $gym->update($request->all());

        return response(['success' => 'Gym Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gym $gym)
    {
        $gym = Gym::findOrFail($gym['id']);

        $gym->delete();

        return response(['success' => 'Gym Deleted Successfully.']);
    }

    /**
     * Get Gym's Owner
     *
     * @param Gym $gym
     * @return \Illuminate\Http\Response
     */

    public function owner(Gym $gym)
    {
        $owner = Gym::findOrFail($gym['id'])->owner()->first();

        return response($owner);
    }
}
