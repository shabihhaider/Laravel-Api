<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;

class UserController extends ApiController // inherit from ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($this->include('tickets')) {
            return UserResource::collection(User::with('tickets')->paginate()); 
        }

        return UserResource::collection(User::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Load the tickets relationship if it is included in the request
        if($this->include('tickets')) {
            return new UserResource($user->load('tickets')); 
        }

        // otherwise, return the user resource, without the tickets relationship
        return new UserResource($user); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
