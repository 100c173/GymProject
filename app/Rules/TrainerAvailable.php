<?php

namespace App\Rules;

use App\Models\Session;
use App\Models\Time;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TrainerAvailable implements ValidationRule
{
    protected $timeId;
    protected $trainerId;
    protected $curent_session_id ;

    /**
     * Create rule with time id and trainer id passed.
     */
    public function __construct($timeId, $trainerId , $curent_session_id)
    {
        $this->timeId = $timeId;
        $this->trainerId = $trainerId;
        $this->curent_session_id = $curent_session_id;
    }

    /**
     * Implement verification logic.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        // Retrieve the current session time based on its ID.
        $time = Time::find($this->timeId);

        // Create Carbon instances for the start and end times of the session.
        $startTime1 = Carbon::createFromFormat('H:i:s', $time->start_time);
        $endTime1   = Carbon::createFromFormat('H:i:s', $time->end_time);

        // Fetch all the trainer's sessions .
        $sessions = Session::where('user_id', $this->trainerId)->get();
        
        // Loop through all the sessions of the trainer.
        foreach ($sessions as $session) {

            if ($session->time->day != $time->day) continue; // if the sessions not the same day no problem 
            if(isset($this->curent_session_id) and $this->curent_session_id == $session->id ) continue ;

            $startTime2 = Carbon::createFromFormat('H:i:s', $session->time->start_time);
            $endTime2 = Carbon::createFromFormat('H:i:s',  $session->time->end_time);

            // Check for overlapping session times.
            if ($startTime1->lt($endTime2) && $startTime2->lt($endTime1)) {
                // If the new session overlaps with an existing session.
                $fail('The selected trainer has another session at the same time.');
                break; // No need to continue checking other sessions after finding a conflict.

            }
        }
    }
}
