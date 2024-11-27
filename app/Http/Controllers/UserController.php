<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // To define how many rows per page
        $entries_number = $request->input('entries_number', 5);

        $users = $this->userService->getAllUsersAfterFiltering($request, $entries_number);

        return view('dashboard.manager.members.list_users', [
            'users' => $users,
            'entries_number' => $entries_number,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.manager.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        //Create user using the UserService class
        $user = $this->userService->create($request);

        // Add flash message
        if ($user) {
            session()->flash('success', 'User created successfully.');
        } else {
            session()->flash('error', 'Failed to Create user.');
        }

        // Redirect based on the value of redirect_to
        return redirect()->route('users.' . $request->redirect_to);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $serviceRatings = $this->userService->getUserRatingServices($user);
        $userRatings =  $this->userService->getUserRatingTrainers($user);
        $subscriptions = $this->userService->getUserActiveSubscriptions($user);

        return view('dashboard.manager.members.view', [
            'user' => $user,
            'serviceRatings' => $serviceRatings,
            'userRatings' => $userRatings,
            'subscriptions' => $subscriptions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('dashboard.manager.members.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //Update user using the UserService class
        $user = $this->userService->update($request, $user);

        // Add flash message
        if ($user) {
            session()->flash('success', 'User updated successfully.');
        } else {
            session()->flash('error', 'Failed to update user.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function forceDelete(string $id) {}
}
