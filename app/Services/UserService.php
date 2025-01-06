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
     * @param array $data To Create the user
     */
    public function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole($data['role']);

        return $user;
    }

    /**
     * For update a user
     * 
     * @param array $data To Update the user
     * @param User $user To know which user will be updated
     */
    public function update(array $data, User $user)
    {
        $user = $user->update($data);

        return $user;
    }

    /**
     *  Delete the specified user
     * 
     *  @param User $user The user to delete
     *  @return bool|null True if the user was deleted, false otherwise
     */
    public function delete(User $user)
    {
        return $user->delete();
    }

    /**
     * Get paginated users with applied filters
     *
     * This function retrieves a paginated list of users from the User model
     * applying filters based on the request data parameter
     * The filters include:
     * - Full Name
     * - Email
     * - Role
     *
     * The function returns the filtered results paginated with 10 items per page
     *
     * @param array $data The incoming data containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered users
     */
    public function getAllUsersAfterFiltering(array $data)
    {
        // To define how many rows per page
        $entries_number = $data['entries_number'] ?? 10;

        $q = User::query();

        $q->when(isset($data['name']), function ($query) use ($data) {
            $query->SearchFullName($data['name']);
        });

        $q->when(isset($data['email']), function ($query) use ($data) {
            $query->SearchEmail($data['email']);
        });

        $q->when(isset($data['role']) && $data['role'] !== 'All', function ($query) use ($data) {
            $query->role($data['role']);
        });

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
