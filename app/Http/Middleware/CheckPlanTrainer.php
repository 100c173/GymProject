<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPlanTrainer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check the plan
        $plan = Plan::find($request->plan_id);

        // If the plan does not need a coach and a coach is passed
        if ($plan && !$plan->with_trainer && $request->trainer_id) {
            return redirect()->back()->withErrors(['error' => 'This plan does not require a trainer, but a trainer was provided.']);
        }

        // If the plan does need a coach and a coach is passed
        if ($plan->with_trainer && !$request->trainer_id) {
            return redirect()->back()->withErrors(['error' => 'This plan requires a trainer, but no trainer was provided.']);
        }

        return $next($request);
    }
}
