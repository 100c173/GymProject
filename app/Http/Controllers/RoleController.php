<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFilterRequest;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{


    /**
     * Service to handle role-related logic 
     * and separating it from the controller
     * 
     * @var RoleService
     */
    protected $roleService;

    /**
     * RoleController constructor
     *
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the RoleService to handle role-related logic
        $this->roleService = $roleService;
    }


    /**
     * Display a listing of the roles after applying filters
     * 
     * @param RoleFilterRequest $request The request object containing filter data 
     * @return View The view displaying the list of roles
     */
    public function index(RoleFilterRequest $request)
    {
        //
        $validated = $request->validated();
        $roles = $this->roleService->getAllRolesAfterFiltering($validated);

        return view('new-dashboard.roles.list_roles', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('new-dashboard.roles.create_role', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param RoleRequest $request To store the role according to the conditions used
     * in this form request
     */
    public function store(RoleRequest $request)
    {
        //
        $validated = $request->validated();
        $role = $this->roleService->create($validated);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($role, 'Role created successfully.', 'Failed to Create role.');

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
        return view('new-dashboard.roles.show_role', [
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('new-dashboard.roles.edit_role', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param RoleRequest $request To update the role according to the conditions used
     * in this form request
     */
    public function update(RoleRequest $request, Role $role)
    {
        //
        $validated = $request->validated();
        $role = $this->roleService->update($validated, $role);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($role, 'Role updated successfully.', 'Failed to update role.');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role = $this->roleService->delete($role);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($role, 'Role Deleted successfully.', 'Failed to Delete role.');

        return redirect()->route('roles.index');
    }
}
