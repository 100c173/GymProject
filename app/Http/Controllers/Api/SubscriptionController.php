<?php

namespace App\Http\Controllers\Api;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    //subscribe in plan 
public function subscribe(Request $request)
{
    $request->validate([
        'start' => 'required|date',
        'user_id' => 'required|exists:users,id',
        'plan_id' => 'required|exists:plans,id',
    ]);

    $plan = Plan::find($request->plan_id);
    if (!$plan) {
        return response()->json(['message' => 'Plan not found'], 404);
    }

    $subscription = Subscription::create([
        'start' => $request->start,
        'end' => now()->addDays($plan->period), // حساب تاريخ الانتهاء
        'user_id' => $request->user_id,
        'plan_id' => $request->plan_id,
    ]);

    return response()->json(['message' => 'Subscription created successfully', 'subscription' => $subscription], 201);
}
//cancel Subscription
public function cancelSubscription($id)
{
    $subscription = Subscription::find($id);
    if (!$subscription) {
        return response()->json(['message' => 'Subscription not found'], 404);
    }

    $subscription->delete();
    return response()->json(['message' => 'Subscription canceled successfully'], 200);
}
// show User Subscriptions 
public function getUserSubscriptions($userId)
{
    $subscriptions = Subscription::with('plan')->where('user_id', $userId)->get();
    if ($subscriptions->isEmpty()) {
        return response()->json(['message' => 'No subscriptions found for this user'], 404);
    }
    return response()->json($subscriptions, 200);
} 
}
