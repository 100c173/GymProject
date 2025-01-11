<?php

namespace App\Services;

use App\Models\Service;
use App\Models\Session;
use Carbon\Carbon;

class SessionService
{
    /**
     * For create a new service
     * 
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $session = Session::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'max_members' => $data['members_number'],
            'user_id' => $data['trainer_id'] ?? null,
            'time_id' => $data['time_id'],
        ]);

        if ($session)
            $session->plans()->attach($data['plan_id']);

        return $session;
    }

    /**
     * For update a session
     * 
     * @param array $data The update data
     * @param Service $session To know which session will be updated
     */
    public function update(array $data, Session $session)
    {
        $session->update($data);

        $session->plans()->sync($data['plan_id']);

        return $session;
    }

    /**
     *  Delete the specified session
     * 
     *  @param Session $session The session to delete
     *  @return bool|null True if the session was deleted, false otherwise
     */
    public function delete(Session $session)
    {
        return $session->delete();
    }

    /**
     * Update the status of the specified session
     * 
     * @param array $data
     * @param Session $session 
     * @return bool 
     */
    public function updateStatus(array $data, Session $session)
    {
        return $session->update([
            'status' => $data['status'],
        ]);
    }

    /**
     * getAllSessionsAfterFilttering based on request parameters
     *
     * This function retrieves a paginated list of sessions from the Session model
     * applying filters based on the request parameters. The filters include:
     * - Session Name ('session_name')
     * - Max Members ('max_members')
     *
     * @param array $data The incoming data containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered sessions
     */
    public function getAllSessionsAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $sessions = Session::with('appointments')
            ->when(
                isset($data['session_name']),
                function ($query) use ($data) {
                    return $query->searchByName($data['session_name']);
                }
            )->when(
                isset($data['max_members']),
                function ($query) use ($data) {
                    return $query->maxMembers($data['max_members']);
                }
            )->paginate($entries_number)->appends(request()->except('page'));

        return $sessions;
    }

}
