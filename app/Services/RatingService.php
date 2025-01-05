<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingService
{

    /**
     * To Create a new rating
     * 
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $rating = Rating::create([
            'rating' => $data['rating'],
            'comment' => $data['comment'],
            'rateable_id' => $data['rateable_id'],
            'rateable_type' => $data['rateable_type'],
            'user_id' => $data['user_id'],
        ]);

        return $rating;
    }

    /**
     * To Edit an rating
     * 
     * @param array $data The update data
     * @param string $id The rating id to update
     */
    public function update(array $data, string $id)
    {
        $rating = Rating::findOrFail($id);

        $rating->update($data);

        return $rating;
    }


    public function show(string $id)
    {
        $rating = Rating::findOrFail($id);

        return $rating;
    }

    public function delete(string $id)
    {
        $rating = Rating::findOrFail($id);

        return $rating->delete();
    }

    /**
     * Retrieve all ratings after applying filters
     *
     * This method applies various filters to the ratings query based on the request parameters
     * It supports filtering by rating, rateable type, rater's full name, and rateable entity's name
     * The results are paginated based on the specified number of entries per page
     *
     * @param array $data The incoming data containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered ratings
     */
    public function getAllRatingsAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $ratings = Rating::query()
            ->when(isset($data['rating']) && $data['rating'] !== 'All', function ($query) use ($data) {

                return $query->ofRating($data['rating']);
            })->when(isset($data['rateable_type']) && $data['rateable_type'] !== '', function ($query) use ($data) {

                return $query->ofType($data['rateable_type']);
            })->when(isset($data['rater_name']), function ($query) use ($data) {

                return $query->ofRaterName($data['rater_name']);
            })->when(isset($data['rateable_name']), function ($query) use ($data) {

                return $query->ofRateableName($data['rateable_name']);
            })->paginate($entries_number);

        return $ratings;
    }
}
