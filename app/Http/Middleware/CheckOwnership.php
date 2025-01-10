<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckOwnership
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $model): Response
    {

        $id = $request->route($model);

        $modelClass = 'App\\Models\\' . ucfirst($model);

        $resource = $modelClass::find($id);
        if (!$resource || !$resource->isOwnedBy(auth()->user()->id))
            return $this->errorResponse('Unauthorized, you dont have permission to update', null, 403);

        return $next($request);
    }
}
