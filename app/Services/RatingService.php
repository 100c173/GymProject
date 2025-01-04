<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingService
{

    public function delete(Rating $rating)
    {
        return $rating->delete();
    }

    /**
     * Retrieve all ratings after applying filters
     *
     * This method applies various filters to the ratings query based on the request parameters
     * It supports filtering by rating, rateable type, rater's full name, and rateable entity's name
     * The results are paginated based on the specified number of entries per page
     *
     * @param Request $request The incoming request containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered ratings
     */
    public function getAllRatingsAfterFilttering(Request $request)
    {
        // To define how many rows per page
        $entries_number = $request->input('entries_number', 10);

        $q = Rating::query();


        // Apply filter for rating
        if ($request->filled('rating') && $request->input('rating') !== 'All') {
            $q->where('rating', $request->input('rating'));
        }

        // Apply filter for rateable type
        if ($request->filled('rateable_type') && $request->input('rateable_type') !== '') {
            $q->where('rateable_type', $request->input('rateable_type'));
        }

        // Apply filter for rater full name
        if ($request->filled('rater_name')) {
            $q->whereHas('user', function ($query) use ($request) {
                $query->SearchFullName($request->input('rater_name'));
            });
        }

        // Apply filter for rateable name
        if ($request->filled('rateable_name')) {
            $q->SearchRateableName($request->input('rateable_name'));
        }


        $ratings = $q->paginate($entries_number);

        return $ratings;
    }
}
