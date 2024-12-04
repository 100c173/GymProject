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
     * @param TimeRequest
     */
    public function create(TimeRequest $request)
    {
        $time = Time::create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day' => $request->day,
        ]);

        return $time;
    }

    /**
     * To Edit a time
     * 
     * @param TimeRequest
     * @param Time
     */
    public function update(TimeRequest $request, Time $time)
    {
        $time = $time->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day' => $request->day,
        ]);

        return $time;
    }

    /**
     * To Delete a time
     * 
     * @param Time
     */
    public function delete(Time $time)
    {
        return $time->delete();
    }

    /**
     * Convert times to 12-hour format
     *
     * This function takes a paginated collection of times and transforms
     * the 'start_time' and 'end_time' fields to a 12-hour format with AM/PM
     * It uses the Carbon library to parse and format the times
     *
     * @param LengthAwarePaginator $times The paginated collection of times
     * @return LengthAwarePaginator The paginated collection with times in 12-hour format
     */
    public function getAllTimesWith12HoursFormat($times)
    {
        $times->getCollection()->transform(function ($time) {
            $time->start_time = Carbon::parse($time->start_time)->format('h:i A');
            $time->end_time = Carbon::parse($time->end_time)->format('h:i A');
            return $time;
        });

        return $times;
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
     * @param Request $request The incoming request containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered times
     */
    public function getAllTimesAfterFilttering(Request $request)
    {
        $entries_number = $request->input('entries_number', 10);
        $q = Time::query();

        if ($request->filled('min_time')) {
            $q->where('start_time', '>=', Carbon::parse($request->input('min_time'))->format('H:i:s'));
        }

        if ($request->filled('max_time')) {
            $q->where('end_time', '<=', Carbon::parse($request->input('max_time'))->format('H:i:s'));
        }

        if ($request->filled('min_date')) {
            $q->where('day', '>=', $request->input('min_date'));
        }

        if ($request->filled('max_date')) {
            $q->where('day', '<=', $request->input('max_date'));
        }

        $times = $q->paginate($entries_number);

        return $times;
    }
}
