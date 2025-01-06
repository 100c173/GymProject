<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Models\Plan;
use App\Models\Session;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkSessionExists')->only('create');
        $this->middleware('check.plan.trainer')->only('store','update');

    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sessionName = $request->get('session_name');
        $maxMembers = $request->get('max_members');

        $sessions = Session::with('appointments');

        if ($sessionName) {
            $sessions->where('name', 'like', '%' . $sessionName . '%');
        }

        if ($maxMembers) {
            $sessions->where('max_members', '<=', $maxMembers);
        }

        $sessions = $sessions->paginate($request->entries_number);

        return view('new-dashboard.sessions.llist_sessions', compact('sessions'));
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
     */
    public function store(SessionRequest $request)
    {
        //create new session
        $session = new Session();
        $session->name = $request->name;
        $session->description = $request->description;
        $session->max_members = $request->members_number;
        if ($request->trainer_id) $session->user_id = $request->trainer_id;
        $session->time_id = $request->time_id;


        // Save session
        if ($session->save()) {
            // Attach plans (supports array of single ID)
            $session->plans()->attach($request->plan_id);

            return redirect()->route('sessions.index')->with('success', 'Session created successfully');
        }

        // Handle save failure
        return back()->with('error', 'Failed to create session. Please try again.');
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
        return view('new-dashboard.sessions.edit_session', compact('session', 'trainers', 'times' ,'plans' , 'cur_plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, Session $session)
    {
        $data=[
            'name' => $request->name,
            'description' => $request->description,
            'max_number' => $request->members_number,
            'time_id' => $request->time_id,
            'status' => $request->status,
        ];

        if($request->trainer_id){
            $data['user_id'] =  $request->trainer_id; 
        }
        $session->update($data);
        $session->plans()->sync($request->plan_id);

        return redirect()->route('sessions.index')->with('success', 'Session updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('sessions.index')->with('success', 'Session deleted successfully');
    }

    public function updateStatus(Request $request, Session $session)
    {

        $session->update([
            'status' => $request->status,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Session updated successfully');
    }
}
