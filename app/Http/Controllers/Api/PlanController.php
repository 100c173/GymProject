<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
   // show all plans
    public function index()
{
    $plans = Plan::with('planType')->get();
    return response()->json($plans, 200);
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




}
