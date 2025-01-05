<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Rating;
use App\Models\Service;
use App\Models\User;
use App\Services\RatingService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    /**
     * Service to handle rating-related logic 
     * and separating it from the controller
     * 
     * @var RatingService
     */
    protected $ratingService;

    /**
     * RatingController constructor
     *
     * @param RatingService $ratingService
     */
    public function __construct(RatingService $ratingService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth:sanctum']);

        // Inject the RatingService to handle rating-related logic
        $this->ratingService = $ratingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::all();

        if ($ratings)
            return $this->successResponse('Success', RatingResource::collection($ratings));

        return $this->errorResponse('Faild');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param RatingRequest $request The request object containing filter data 
     */
    public function store(RatingRequest $request)
    {
        $validated = $request->validated();
        $rating = $this->ratingService->create($validated);

        if ($rating)
            return $this->successResponse('Success', new RatingResource($rating));

        return $this->errorResponse('Faild');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rating = $this->ratingService->show($id);
        if ($rating)
            return $this->successResponse('Success', new RatingResource($rating));

        return $this->errorResponse('Faild');
    }

    /**
     * Update the specified resource in storage
     * 
     * @param RatingRequest $request The request object containing filter data 
     */
    public function update(RatingRequest $request, string $id)
    {
        $validated = $request->validated();
        $rating = $this->ratingService->update($validated, $id);

        if ($rating)
            return $this->successResponse('Success', new RatingResource($rating));

        return $this->errorResponse('Faild');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rating = $this->ratingService->delete($id);

        if ($rating)
            return $this->successResponse('Success');

        return $this->errorResponse('Faild');
    }
}