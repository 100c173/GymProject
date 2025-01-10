<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberShipApplicationRequest;
use App\Http\Resources\MembershipApplicationResource;
use App\Models\MembershipApplication;
use App\Services\MembershipApplicationService;



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
        $this->middleware('auth:sanctum');
        $this->middleware('check.application')->only('store');

        // Inject the PermissionService to handle membershipApplication-related logic
        $this->membershipApplicationService = $membershipApplicationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Retrieve membership requests for the current user

        $applications = $this->membershipApplicationService
            ->getUserMembershipApplicationApi();
        if ($applications)
            return $this->successResponse(
                'Membership request has been successfully retrieved.',
                MembershipApplicationResource::collection($applications)
            );

        return $this->errorResponse('Faild');
    }

    /**
     * Store a newly created membership application
     *
     * @param MembershipApplicationRequest $request
     * @return JsonResponse
     */
    public function store(MemberShipApplicationRequest $request)
    {
        $validated = $request->validated();

        $application = $this->membershipApplicationService->createApi($validated);

        // Successful response
        if ($application) {
            return $this->successResponse(
                'Your membership application has been submitted successfully.',
                new MembershipApplicationResource($application),
                201
            );
        }

        return $this->errorResponse('Failed to submit the membership application.');
    }


    /**
     * Display the specified membership application
     *
     * @param MembershipApplication $membershipApplication
     * @return JsonResponse
     */
    public function show(MembershipApplication $membershipApplication)
    {
        return $this->successResponse(
            'The specified membership request has been successfully retrieved.',
            new MembershipApplicationResource($membershipApplication)
        );
    }


    /**
     * Update the specified membership application in storage
     *
     * @param MembershipApplicationRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(MembershipApplicationRequest $request, string $id)
    {
        $validated = $request->validated();

        $membershipApplication = $this->membershipApplicationService->updateApi($validated, $id);

        // Return success response
        if ($membershipApplication) {
            return $this->successResponse(
                'Your membership application has been updated successfully.',
                new MembershipApplicationResource($membershipApplication)
            );
        }

        return $this->errorResponse('Failed to update the membership application.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $membershipApplication = $this->membershipApplicationService->deleteApi($id);

        if ($membershipApplication)
            return $this->successResponse('The membership application has been deleted successfully.');

        return $this->errorResponse('Faild');
    }
}
