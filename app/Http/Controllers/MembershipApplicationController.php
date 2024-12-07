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
        $this->middleware(['role:Admin'])->only('updateStatus', 'destroy' );

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = MembershipApplication::with('user')->get();
        return view('dashboard.manager.membership.membership',compact('memberships'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        $application = MembershipApplication::findOrFail($id);

        
        if ($request->status === 'accept') {
            $application->status = 'accepted';
        } 
        else {
            $application->status = 'rejected';
        }

        $application->save();

        return redirect()->back()->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = MembershipApplication::findOrFail($id);
        $application->destroy();
        return redirect()->back()->with('success', '');
    }
}
