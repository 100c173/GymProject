<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Plan;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use Carbon\Carbon;



class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->middleware('check.subscription.owner')->only(['update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = $this->subscriptionService->showAllMySubscriptions();
        return $this->successResponse('Subscriptions request has been successfully retrieved.', SubscriptionResource::collection($subscriptions));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        $validated = $request->validated();
        $subscription = $this->subscriptionService->createNewSupscription($validated);
        return $this->successResponse(
            'Your Subscription application has been submitted successfully.',
            new SubscriptionResource($subscription),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return $this->successResponse(
            'Your Subscription application has been submitted successfully.',
            new SubscriptionResource($subscription),
            201
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription = $this->subscriptionService->updateMySubscription($request,$subscription);

        return $this->successResponse(
            'Your subscription has been updated successfully.',
            new SubscriptionResource($subscription)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return $this->successResponse('The subscription has been deleted successfully.');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function forceDelete(Subscription $subscription)
    {
        $subscription->forceDelete();
        return $this->successResponse('The subscription has been permanently deleted successfully.');
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore(int $id)
    {
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        $subscription->restore();

        return $this->successResponse('The subscription has been restored successfully.');
    }
}
