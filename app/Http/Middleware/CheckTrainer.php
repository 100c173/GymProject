<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTrainer
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->rateable_type == 'App\Models\Service')
            return $next($request);

        $trainer = User::find($request->rateable_id);

        if ($trainer && $trainer->hasRole('trainer'))
            return $next($request);

        return $this->errorResponse('The User Who You Want To Rate Isn Not Trainer Please Choose A Trainer And Try Again');
    }
}
