<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserFilterRequest;
use App\Services\UserService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

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
     * Display a listing of the users after applying filters
     * 
     * @param UserFilterRequest $request The request object containing filter data 
     * @return View The view displaying the list of users
     */
    public function index(UserFilterRequest $request)
    {
        $validated = $request->validated();
        $users = $this->userService->getAllUsersAfterFiltering($validated);

        return view('new-dashboard.users.list_users', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = ModelsRole::all();

        return view('new-dashboard.users.create_user', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param UserRequest $request To store the user according to the conditions used
     * in this form request
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userService->create($validated);

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
        // Using Accessor from User Model
        $serviceRatings = $user->getUserRatingServices();
        $userRatings =  $user->getUserRatingTrainers();
        $subscriptions = $user->getUserActiveSubscriptions();


        return view('new-dashboard.users.view', [
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
        $roles = ModelsRole::all();

        return view('new-dashboard.users.edit_user', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UserRequest $request To update the user according to the conditions used
     * in this form request
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();
        $user = $this->userService->update($validated, $user);
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
        $user = $this->userService->delete($user);

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
     * @param string $id to find the user
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
        $entries_number = $request->input('entries_number', 10);
        $users = $this->userService->getAllTrashedUsersAfterFiltering($request, $entries_number);

        return view('new-dashboard.users.trashed_users', [
            'users' => $users,
            'entries_number' => $entries_number,
        ]);
    }
}
