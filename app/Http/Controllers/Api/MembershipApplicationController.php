<?php

namespace App\Http\Controllers\API;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberShipApplicationRequest;
use App\Http\Resources\MembershipApplicationResource;
use App\Models\MembershipApplication;
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
        $applications = auth()->user() ; 

        return response()->json([
            'message' => 'Membership request has been successfully retrieved.' ,
             MembershipApplicationResource::collection($applications),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberShipApplicationRequest $request)
    {
        try {

            // Upload files
            $imagePath = FileHelper::uploadFile($request->file('image'), 'images/MembershipApplications');
            $pdfPath = FileHelper::uploadFile($request->file('pdf'), 'MembershipApplications_CV');
    
            // Create record in database
            $application = MembershipApplication::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'image' => $imagePath,
                'pdf' => $pdfPath,
                'status' => 'pending',
            ]);
    
            //Successful response
            return response()->json([
                'message' => 'Your membership application has been submitted successfully.',
                'data' => new MembershipApplicationResource($application),
            ], 201);
    
        } catch (ValidationException $e) {
            // When there are validation errors
            return response()->json([
                'message' => 'Validation error occurred.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            // When a general error occurs
            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MembershipApplication $application)
    {
        return response()->json([
           'message' => 'The specified membership request has been successfully retrieved.', 
            new MembershipApplicationResource($application),
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberShipApplicationRequest $request, MembershipApplication $application)
    {
        try {
            // Upload Files
            $imagePath = $request->hasFile('image') 
                ? FileHelper::uploadFile($request->file('image'), 'images/MembershipApplications') : $application->image;
 
            $pdfPath = $request->hasFile('pdf') 
                ? FileHelper::uploadFile($request->file('pdf'), 'MembershipApplications_CV') : $application->pdf;
    
            // Update the application record
            $application->update([
                'first_name' => $request->first_name ?? $application->first_name,
                'last_name' => $request->last_name ?? $application->last_name,
                'image' => $imagePath,
                'pdf' => $pdfPath,
                'status' => $application->status, 
            ]);
    
            // Return success response
            return response()->json([
                'message' => 'Your membership application has been updated successfully.',
                'data' => new MembershipApplicationResource($application),
            ], 200);
    
        } catch (ValidationException $e) {
            // Return validation error response
            return response()->json([
                'message' => 'Validation error occurred.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Return general error response
            return response()->json([
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipApplication $application)
    {
        $application->delete();
        return response()->json([
            'message' => 'The membership application has been deleted successfully.',
            ], 200);
    }
}
