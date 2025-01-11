<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Plan;

class EnsurePlanIsUnique
{
    public function handle(Request $request, Closure $next)
    {
        if (Plan::where('name', $request->name)->exists()) {
            return redirect()->back()->with('error', 'The plan already exists.');
        }
        return $next($request);
    }
}
