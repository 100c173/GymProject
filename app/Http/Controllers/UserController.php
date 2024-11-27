<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // To define how many rows per page
        $entries_number = $request->input('entries_number', 5);

        $q = User::query();

        // Search by name
        if ($request->input('searched_name'))
            $q = User::where('first_name', 'like', '%' . $request->searched_name . '%');

        $users = $q->paginate($entries_number);
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
    public function store(UserRequest $request)
    {
        //
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // Add flash message
        session()->flash('success', 'User created successfully.');
        // Redirect based on the value of redirect_to
        if ($request->redirect_to == 'index') {
            return redirect()->route('users.index');
        } else {
            return redirect()->route('users.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $serviceRatings = $user->ratings()->where('rateable_type', 'App\Models\Service')->get();
        $userRatings = $user->ratings()->where('rateable_type', 'App\Models\User')->get();
        $subscriptions = UserController::activeSubscriptions($user);
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
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

    public function forceDelete(string $id) {}

    public function activeSubscriptions($user)
    {
        $today = Carbon::today();
        return $user->subscriptions()->where('start', '<=', $today)->where('end', '>=', $today)->get();
    }
}
