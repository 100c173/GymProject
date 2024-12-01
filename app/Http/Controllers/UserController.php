<?php

namespace App\Http\Controllers;

use App\Helpers\FlashMessageHelper;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use App\Models\User;
use Carbon\Carbon;
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
        $this->middleware(['auth']);

        // Inject the UserService to handle user-related logic
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

        return view('dashboard.manager.members.users.list_users', [
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
        return view('dashboard.manager.members.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param CreateUserRequest $request To store the user according to the conditions used
     * in this form request
     */
    public function store(CreateUserRequest $request)
    {
        // Create user using the UserService class
        $user = $this->userService->create($request);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($user, 'User created successfully.', 'Failed to Create user.');

        // Redirect based on the value of redirect_to
        return redirect()->route('users.' . $request->redirect_to);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Using methods from UserService class
        $serviceRatings = $this->userService->getUserRatingServices($user);
        $userRatings =  $this->userService->getUserRatingTrainers($user);
        $subscriptions = $this->userService->getUserActiveSubscriptions($user);


        return view('dashboard.manager.members.users.view', [
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
        return view('dashboard.manager.members.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateUserRequest $request To update the user according to the conditions used
     * in this form request
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //Update user using the UserService class
        $user = $this->userService->update($request, $user);
        $redirect = request()->query('redirect', route('users.index'));

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($user, 'User updated successfully.', 'Failed to update user.');

        return redirect($redirect);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = $user->delete();

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($user, 'User Deleted successfully.', 'Failed to Delete user.');

        return redirect()->route('users.index');
    }

    /**
     * Remove the soecified resource permently from storage
     * @param string $id To find the user
     */
    public function forceDelete(string $id)
    {
        // get the url for the previous page to redirect the user
        $redirect = request()->query('redirect', route('users.index'));

        $user = $this->userService->forceDelete($id);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($user, 'User Deleted successfully.', 'Failed to Delete user.');

        return redirect($redirect);
    }

    /**
     * To restore the user which it's deleted
     * Notice: Can't restore the users who's deleted using forceDelete
     * 
     * @param $id to find the user
     */
    public function restore(string $id)
    {
        $user = $this->userService->restore($id);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($user, 'User Restored successfully.', 'Failed to Restore user.');

        return redirect()->route('users.trashed');
    }

    /**
     * Display a listing of deleted resource
     */
    public function trashedUsers(Request $request)
    {
        $entries_number = $request->input('entries_number', 5);
        $users = $this->userService->getAllTrashedUsersAfterFiltering($request, $entries_number);

        return view('dashboard.manager.members.users.trashed_users', [
            'users' => $users,
            'entries_number' => $entries_number,
        ]);
    }
}
