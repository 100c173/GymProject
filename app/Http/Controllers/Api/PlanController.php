<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;

use Illuminate\Http\Request;
use App\Services\PlanService;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;

class PlanController extends Controller
{
    protected $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }
   // show all plans
    public function index()
{
    $plans = $this->planService->getAllPlans();
    if (!$plans) {
        return $this->errorResponse('Faild');
    }
    return $this->successResponse('All plans retrieved successfully', PlanResource::collection($plans));
}
   //show details plan
public function show($id)
{
    $plan = Plan::with(['planType', 'subscriptions'])->find($id);
    if (!$plan) {
        return response()->json(['message' => 'Plan not found'], 404);
    }
    return response()->json($plan, 200);
}

//show plan with sessions related in
public function showPlanWithSession($id)
{
    $plan = $this->planService->getPlanWithSessions($id);

    if (!$plan) {
        return $this->errorResponse('Faild');
    }

    return $this->successResponse(
        'plan request has been successfully .',
        new PlanResource($plan)
    );
}




}
