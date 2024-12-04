<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberShipApplicationRequest;
use App\Http\Resources\MembershipApplicationResource;
use App\Models\MembershipApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class MembershipApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Retrieve membership requests for the current user
        $id = auth()->user()->id;
        $user = User::FindOrFail($id);
        $applications = MembershipApplication::where('user_id', $user->id)->get();
        return response()->json([
            'message' => 'Membership request has been successfully retrieved.',
            'datat'  => MembershipApplicationResource::collection($applications),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberShipApplicationRequest $request)
    {

        // Upload files
        $imagePath = null;
        $pdfPath  = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $imagePath = uploadImage($file, "images/MembershipApplications"); // public disk by default
        }

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');

            $pdfPath = uploadImage($file, "MembershipApplications_CV"); // public disk by default
        }


        $user = auth()->user();

        // Create record in database
        $application = MembershipApplication::create([
            'user_id' => $user->id,
            'image_path' => $imagePath,
            'pdf_path' => $pdfPath,
            'status' => 'pending',
        ]);

        //Successful response
        return response()->json([
            'message' => 'Your membership application has been submitted successfully.',
            'data' => new MembershipApplicationResource($application),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipApplication $membership_application)
    {

        return response()->json([
            'message' => 'The specified membership request has been successfully retrieved.',
            'data' => new MembershipApplicationResource($membership_application),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MembershipApplicationRequest $request, MembershipApplication $membership_application)
    {
        // Upload files
        $imagePath = $membership_application->image_path;
        $pdfPath  = $membership_application->pdf_path;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $imagePath = uploadImage($file, "images/MembershipApplications"); // public disk by default
        }

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');

            $pdfPath = uploadImage($file, "MembershipApplications_CV"); // public disk by default
        }


        // Update the application record
        $membership_application->update([
            'image' => $imagePath,
            'pdf' => $pdfPath,
        ]);

        // Return success response
        return response()->json([
            'message' => 'Your membership application has been updated successfully.',
            'data' => new MembershipApplicationResource($membership_application),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipApplication $membership_application)
    {

        $membership_application->delete();
        return response()->json([
            'message' => 'The membership application has been deleted successfully.',
        ], 200);
    }
}
