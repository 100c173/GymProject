<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserService
{
    /**
     * For create a new user
     */
    public function create(UserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return $user;
    }

    /**
     * To get all users after filtering with paginated data
     */
    public function getAllUsersAfterFiltering(Request $request, $entries_number)
    {
        $q = User::query();

        // Search by name
        if ($request->input('searched_name'))
            $q = User::where('first_name', 'like', '%' . $request->searched_name . '%');

        return $q->paginate($entries_number);
    }

    /**
     * To get the subscriptions that are active and not expired
     */
    public function getUserActiveSubscriptions(User $user)
    {
        $today = Carbon::today();
        return $user->subscriptions()->where('start', '<=', $today)->where('end', '>=', $today)->get();
    }

    /**
     * To get all ratings related with services that user rate it
     */
    public function getUserRatingServices(User $user)
    {
        return $user->ratings()->where('rateable_type', 'App\Models\Service')->get();
    }

    /**
     * To get all ratings related with Trainer that user rate it
     */
    public function getUserRatingTrainers(User $user)
    {
        return $user->ratings()->where('rateable_type', 'App\Models\User')->get();
    }
}
