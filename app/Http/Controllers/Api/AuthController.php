<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    // Use ApiResponseTrait to standardize API responses
    use ApiResponseTrait;

    /**
     * Service to handle auth-related logic 
     * and separating it from the controller
     * 
     * @var AuthService
     */
    protected $authService;

    /**
     * AuthController constructor
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        // Inject the AuthService to handle auth-related logic
        $this->authService = $authService;
    }

    /**
     * Handle user registration
     *
     * @param RegisterRequest $request Validates the registration credentials
     * @return JsonResponse The success response including token and user details or an error message
     */
    public function register(RegisterRequest $request)
    {
        $success = $this->authService->register($request);

        if ($success)
            return $this->registerResponse($success);

        return $this->errorResponse("Registeration faild");
    }


    /**
     * Handle user login
     *
     * @param Request $request The incoming request containing email and password
     * @return JsonResponse success response including user details and token (error message on failure)
     */
    public function login(Request $request)
    {
        $success = $this->authService->login($request);

        if ($success)
            return $this->loginResponse($success['user'], $success['token']);

        return $this->errorResponse("Logged in faild");
    }

    /**
     * Handle user logout
     *
     * @return JsonResponse The success message or an error message.
     */
    public function logout()
    {
        $success = $this->authService->logout();

        if ($success)
            return $this->logoutResponse();

        return $this->errorResponse('Logged out faild');
    }
}
