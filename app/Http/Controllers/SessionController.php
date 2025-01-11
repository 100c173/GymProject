<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionFilterRequest;
use App\Http\Requests\SessionRequest;
use App\Models\Plan;
use App\Models\Session;
use App\Models\Time;
use App\Models\User;
use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    /**
     * Service to handle session-related logic 
     * and separating it from the controller
     * 
     * @var SessionService
     */
    protected $sessionService;

    /**
     * SessionController constructor
     *
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->middleware('checkSessionExists')->only('create');
        $this->middleware('check.plan.trainer')->only('store','update');


        // Inject the PermissionService to handle session-related logic
        $this->sessionService = $sessionService;
    }

    /**
     * Display a listing of the sessions after applying filters
     * 
     * @param SessionFilterRequest $request The request object containing filter data 
     * @return View The view displaying the list of sessions
     */
    public function index(SessionFilterRequest $request)
    {
        $validated = $request->validated();
        $sessions = $this->sessionService->getAllSessionsAfterFiltering($validated);

        return view('new-dashboard.sessions.llist_sessions', [
            'sessions' => $sessions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = User::role('trainer')->get();
        $times = Time::all();
        $plans = Plan::all();
        return view('new-dashboard.sessions.create_session', compact('trainers', 'times', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param SessionRequest $request To store the session according to the conditions used
     * in this form request
     */
    public function store(SessionRequest $request)
    {
        $validated = $request->validated();
        $session = $this->sessionService->create($validated);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($session, 'Session created successfully.', 'Failed to create session.');

        return redirect()->route('sessions.' . $request->redirect_to);
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {

        return view('new-dashboard.sessions.show_session', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        $trainers = User::role('trainer')->get();
        $times = Time::all();
        $plans = Plan::all();
        $cur_plan = $session->plans;
        return view('new-dashboard.sessions.edit_session', compact('session', 'trainers', 'times', 'plans', 'cur_plan'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param SessionRequest $request To update the session according to the conditions used
     * in this form request
     */
    public function update(SessionRequest $request, Session $session)
    {
        $validated = $request->validated();
        $session = $this->sessionService->update($validated, $session);

        // using the method from FlashMessageHelper to alert the user about success or failure
        flashMessage($session, 'Session updated successfully.', 'Failed to update session.');

        return redirect()->route('sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $deleted = $this->sessionService->delete($session);

        // using the method from FlashMessageHelper to alert the user about success or failure
        flashMessage($deleted, 'Session deleted successfully.', 'Failed to delete session.');

        return redirect()->route('sessions.index');
    }
    
    /**
     * Update the status of the specified session
     * 
     * @param Request $request
     * @param Session $session
     */
    public function updateStatus(Request $request, Session $session)
    {
        $sessionStatus = $this->sessionService->updateStatus($request->all(), $session);

        // using the method from FlashMessageHelper to alert the user about success or failure
        flashMessage($sessionStatus, 'Session status updated successfully.', 'Failed to update session status.');

        return redirect()->route('sessions.index');
    }
}
