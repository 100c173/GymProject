<?php

namespace App\Services;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class UserService
{
    /**
     * For create a new user
     * 
     * @param CreateUserRequest $request To Create the user
     */
    public function create(CreateUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return $user;
    }

    /**
     * For update a user
     * 
     * @param UpdateUserRequest $request To Update the user
     * @param User $user To know which user will be updated
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        return $user;
    }

    /**
     * To get all users after filtering with paginated data
     * 
     * @param Request $request To Apply the filtering if it's found
     */
    public function getAllUsersAfterFiltering(Request $request)
    {
        // To define how many rows per page
        $entries_number = $request->input('entries_number', 10);

        $q = User::query();

        // Search using SearchFullName scope in the User model
        if ($request->filled('name')) {
            $q->SearchFullName($request->name);
        }

        if ($request->filled('role') && $request->role !== 'All') {
            $q->role($request->role);
        }

        return $q->paginate($entries_number);
    }

    /**
     * To get the subscriptions that are active and not expired
     * 
     * @param User $user To use it in relationship
     */
    public function getUserActiveSubscriptions(User $user)
    {
        $today = Carbon::today();
        return $user->subscriptions()->where('start', '<=', $today)->where('end', '>=', $today)->get();
    }

    /**
     * To get all ratings related with services that user rate it
     * 
     * @param User $user To use it in relationship
     */
    public function getUserRatingServices(User $user)
    {
        return $user->ratings()->where('rateable_type', 'App\Models\Service')->get();
    }

    /**
     * To get all ratings related with Trainer that user rate it
     * 
     * @param User $user To use it in relationship
     */
    public function getUserRatingTrainers(User $user)
    {
        return $user->ratings()->where('rateable_type', 'App\Models\User')->get();
    }

    /**
     * To get all trashed users with filtering and paginated data
     * 
     * @param Request $request To Apply the filtering if it's found
     * @param $entries_number to know how many recordes per page
     */
    public function getAllTrashedUsersAfterFiltering(Request $request, $entries_number)
    {
        $q = User::onlyTrashed();

        // Search using SearchFullName scope in the User model
        if ($request->filled('name')) {
            $q->SearchFullName($request->name);
        }

        if ($request->filled('role') && $request->role !== 'All') {
            $q->role($request->role);
        }

        return $q->paginate($entries_number);
    }

    /**
     * For delete a user permenently
     * 
     * @param string $id Search the user by id
     */
    public function forceDelete(string $id)
    {
        $user = User::withTrashed()->find($id);
        return $user->forceDelete();
    }

    /**
     * To restore a user
     * 
     * @param string $id Search the user by id
     */
    public function restore(string $id)
    {
        return User::withTrashed()->find($id)->restore();
    }
}
