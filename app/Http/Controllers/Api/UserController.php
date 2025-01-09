<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFilterRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Service to handle user-related logic 
     * and separating it from the controller
     * 
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth:sanctum']);

        // To make sure that the user who want to update or delete own the resource
        $this->middleware(['check.ownership:user'])->only(['update', 'delete']);

        // Inject the UserService to handle user-related logic
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UserFilterRequest $request)
    {
        $validated = $request->validated();
        $users = $this->userService->getAllUsersAfterFiltering($validated);

        if ($users)
            return $this->successResponse('Success', [
                UserResource::collection($users),
            ]);

        return $this->errorResponse('Faild');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->showApi($id);

        if ($user)
            return $this->successResponse('Success', [
                new UserResource($user),
            ]);

        return $this->errorResponse('Faild');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = $this->userService->update($validated, $id);

        if ($user)
            return $this->successResponse('Success', [
                new UserResource($user),
            ]);

        return $this->errorResponse('Faild');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->forceDelete($id);

        if ($user)
            return $this->successResponse('Success');

        return $this->errorResponse('Faild');
    }

}
