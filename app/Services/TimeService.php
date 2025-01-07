<?php

namespace App\Services;

use App\Http\Requests\TimeRequest;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeService
{

    /**
     * To Create a new time
     * 
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $time = Time::create([
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'day' => $data['day'],
        ]);

        return $time;
    }

    /**
     * To Edit a time
     * 
     * @param array $data The update data
     * @param Time $time The time to update
     */
    public function update(array $data, Time $time)
    {
        $time = $time->update($data);

        return $time;
    }

    /**
     *  Delete the specified time
     * 
     *  @param Time $time The time to delete
     *  @return bool|null True if the time was deleted, false otherwise
     */
    public function delete(Time $time)
    {
        return $time->delete();
    }

    /**
     * Get paginated times with applied filters
     *
     * This function retrieves a paginated list of times from the Time model
     * applying filters based on the request parameters
     * The filters include:
     * - Minimum start time ('min_time')
     * - Maximum end time ('max_time')
     * - Minimum date ('min_date')
     * - Maximum date ('max_date')
     *
     * The function formats the times to a 24-hour format for comparison and
     * returns the filtered results paginated with 10 items per page
     *
     * @param array $data The incoming data containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered times
     */
    public function getAllTimesAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $times = Time::query()
            ->when(
                isset($data['min_time']),
                function ($query) use ($data) {
                    return $query->minTime($data['min_time']);
                }
            )->when(
                isset($data['max_time']),
                function ($query) use ($data) {
                    return $query->maxTime($data['max_time']);
                }
            )->when(
                isset($data['min_date']),
                function ($query) use ($data) {
                    return $query->minDate($data['min_date']);
                }
            )->when(
                isset($data['max_date']),
                function ($query) use ($data) {
                    return $query->maxDate($data['max_date']);
                }
            )->paginate($entries_number);

        return $times;
    }
}
