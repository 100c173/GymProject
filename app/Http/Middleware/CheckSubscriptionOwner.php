<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the subscription directly using route model binding
        $subscription = $request->route('subscription'); // 'subscription' is the name of the route parameter

        // Check if the authenticated user is the owner of the subscription
        if ($subscription->user_id !== auth()->id()) {
            // If not, return an unauthorized response
            return response()->json(['message' => 'You are not authorized to modify this subscription.'], 403);
        }
        return $next($request);
    }
}
