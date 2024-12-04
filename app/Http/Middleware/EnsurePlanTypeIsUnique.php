<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PlanType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePlanTypeIsUnique
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (PlanType::where('name', $request->name)->exists()) {
            return redirect()->back()->with('error', 'The plan type already exists.');
        }
        return $next($request);
    }
}
