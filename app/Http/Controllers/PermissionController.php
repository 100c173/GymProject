<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionFilterRequest;
use App\Http\Requests\PermissionRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


    /**
     * Service to handle permission-related logic 
     * and separating it from the controller
     * 
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * PermissionController constructor
     *
     * @param PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the PermissionService to handle permission-related logic
        $this->permissionService = $permissionService;
    }


    /**
     * Display a listing of the permissions after applying filters
     * 
     * @param PermissionFilterRequest $request The request object containing filter data 
     * @return View The view displaying the list of permissions
     */
    public function index(PermissionFilterRequest $request)
    {
        $validated = $request->validated();
        $permissions = $this->permissionService->getAllPermissionsAfterFiltering($validated);

        return view('new-dashboard.permisions.list_permissions', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('new-dashboard.permisions.create_permision');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param PermissionRequest $request To store the permission according to the conditions used
     * in this form request
     */
    public function store(PermissionRequest $request)
    {
        //
        $validated = $request->validated();
        $permission =  $this->permissionService->create($validated);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($permission, 'Permission created successfully.', 'Failed to Create permission.');

        return redirect()->route('permissions.'. $request->redirect_to);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
        return view('new-dashboard.permisions.show_permission', [
            'permission' => $permission,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
        return view('new-dashboard.permisions.edit_permission', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param PermissionRequest $request To update the permission according to the conditions used
     * in this form request
     */
    public function update(PermissionRequest $request, Permission $permission)
    {

        $validated = $request->validated();
        $permission =  $this->permissionService->update($validated, $permission);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($permission, 'Permission updated successfully.', 'Failed to update permission.');

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
        $permission = $permission->delete();

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($permission, 'Permission Deleted successfully.', 'Failed to Delete permission.');

        return redirect()->route('permissions.index');
    }
}
