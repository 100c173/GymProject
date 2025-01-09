<?php

namespace App\Http\Middleware;

use App\Models\MembershipApplication;
use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckExistingApplication
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userId = Auth::user()->id;

        $existingApplication = MembershipApplication::UserMembershipApplication($userId)->first();

        if ($existingApplication) {
            return $this->errorResponse('You already have an existing application.');
        }

        return $next($request);
    }
}
