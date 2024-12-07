<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRequest;
use App\Models\Time;
use App\Services\TimeService;
use Illuminate\Http\Request;

class TimeController extends Controller
{

    /**
     * Service to handle time-related logic 
     * and separating it from the controller
     * 
     * @var TimeService
     */
    protected $timeService;

    /**
     * TimeController constructor
     *
     * @param TimeService $timeService
     */
    public function __construct(TimeService $timeService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the TimeService to handle time-related logic
        $this->timeService = $timeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $times =  $this->timeService->getAllTimesAfterFilttering($request);
        $times = $this->timeService->getAllTimesWith12HoursFormat($times);
        return view('new-dashboard.time.list_times', [
            'times' => $times,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('new-dashboard.time.create_time');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeRequest $request)
    {
        //
        $time = $this->timeService->create($request);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($time, 'Time created successfully.', 'Failed to Create time.');

        return redirect()->route('times.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Time $time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Time $time)
    {
        //
        return view('new-dashboard.time.edit_time', [
            'time' => $time,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeRequest $request, Time $time)
    {
        //

        $time = $this->timeService->update($request, $time);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($time, 'Time updated successfully.', 'Failed to update time.');

        return redirect()->route('times.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Time $time)
    {
        //
       $time = $this->timeService->delete($time);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($time, 'User Deleted successfully.', 'Failed to Delete user.');

        return redirect()->route('times.index');
    }
}
