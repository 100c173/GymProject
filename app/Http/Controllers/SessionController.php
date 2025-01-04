<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Models\Session;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
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

        return view('new-dashboard.sessions.llist_sessions',compact('sessions')) ; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = User::role('trainer')->get();
        $times = Time::all();
       return view('new-dashboard.sessions.create_session',compact('trainers','times'));
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
        $session->user_id = $request->trainer_id;  
        $session->time_id = $request->time_id;  
        $session->save();  
        
        return redirect()->route('sessions.index')->with('success', 'Session created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {

        return view('new-dashboard.sessions.show_session',compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        $trainers = User::role('trainer')->get();
        $times = Time::all();
        return view('new-dashboard.sessions.edit_session',compact('session','trainers','times'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, Session $session)
    {
        
        $session->update([
            'name' => $request->name,
            'description' => $request->description,
            'max_number' => $request->members_number,
            'user_id' => $request->trainer_id,
            'time_id' => $request->time_id,
            'status' => $request->status,
        ]);
        
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
