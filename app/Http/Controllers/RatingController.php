<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Services\RatingService;
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
        $this->middleware(['auth']);

        // Inject the RatingService to handle rating-related logic
        $this->ratingService = $ratingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
       $ratings = $this->ratingService->getAllRatingsAfterFilttering($request);
        return view('new-dashboard.rating.list_rating', [
            'ratings' => $ratings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
