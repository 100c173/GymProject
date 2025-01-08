<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use App\Services\MembershipApplicationService;
use Illuminate\Http\Request;

class MembershipApplicationController extends Controller
{

    /**
     * Service to handle membershipApplication-related logic 
     * and separating it from the controller
     * 
     * @var MembershipApplicationService
     */
    protected $membershipApplicationService;

    /**
     * MembershipApplicationController constructor
     *
     * @param MembershipApplicationService $membershipApplicationService
     */
    public function __construct(MembershipApplicationService $membershipApplicationService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Apply the role middleware to ensure the user is admin
        $this->middleware(['role:admin'])->only('updateStatus', 'destroy');

        // Inject the PermissionService to handle membershipApplication-related logic
        $this->membershipApplicationService = $membershipApplicationService;
    }

    /**
     * Display a listing of the permissions after applying filters
     * 
     * @param Request $request The request object containing filter data 
     * @return View The view displaying the list of membership applications
     */
    public function index(Request $request)
    {
        $memberships = $this->membershipApplicationService
            ->getAllMembershipApplicationsAfterFiltering($request->all());

        return view('new-dashboard.membership_application.list_membership_applications', compact('memberships'));
    }


    /**
     * Update the status of the specified membership application
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function updateStatus(Request $request, string $id)
    {
        $status =  $this->membershipApplicationService->updateStatus($request->all(), $id);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($status, 'Status updated successfully.', 'Failed to Update status.');

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */
    public function show(string $id)
    {
        $membership = $this->membershipApplicationService->show($id);

        return view('new-dashboard.membership_application.show_membership_applications', [
            'membership' => $membership,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $membership = $this->membershipApplicationService->delete($id);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($membership, 'Membership application Deleted successfully.', 'Failed to Delete membership application.');

        return redirect()->route('membership_applications');
    }
}
