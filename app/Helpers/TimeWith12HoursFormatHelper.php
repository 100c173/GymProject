<?php

use Carbon\Carbon;


function TimeWith12HoursFormat($time)
{
    return Carbon::parse($time)->format('h:i A');
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
function getAllTimesWith12HoursFormat($times)
{
    $times->getCollection()->transform(function ($time) {
        $time->start_time = TimeWith12HoursFormat($time->start_time);
        $time->end_time = TimeWith12HoursFormat($time->end_time);
        return $time;
    });

    return $times;
}
