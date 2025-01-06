<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use Illuminate\Http\Request;

class MembershipApplicationController extends Controller
{

    public function __construct()
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Apply the role middleware to ensure the user is admin
        $this->middleware(['role:admin'])->only('updateStatus', 'destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = MembershipApplication::with('user')->get();
        return view('new-dashboard.membership_application.list_membership_applications', compact('memberships'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        $application = MembershipApplication::findOrFail($id);


        if ($request->status === 'accept') {
            $application->status = 'accepted';
            ($application->user)->assignRole('trainer');
        } else {
            $application->status = 'declined';
        }


        $application->save();

        return redirect()->back()->with('success', '');
    }

    /**
     * Display a listing of the resource.
     */
    public function show(string $id)
    {
        $membership = MembershipApplication::findOrFail($id);
        return view('new-dashboard.membership_application.show_membership_applications', [
            'membership' => $membership,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = MembershipApplication::findOrFail($id);
        $application->delete();
        return redirect()->route('membership_applications')->with('success', '');
    }
}
