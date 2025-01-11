<?php

namespace App\Services;

use App\Models\MembershipApplication;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MembershipApplicationService
{

    /**
     * Get the membership application for the authenticated user
     *
     * @return MembershipApplication|null
     */
    public function getUserMembershipApplicationApi()
    {
        $userId = auth()->user()->id;

        return MembershipApplication::UserMembershipApplication($userId)->first();
    }



    /**
     * Create a new membership application
     *
     * @param array $data
     * @return MembershipApplication
     */
    public function createApi(array $data)
    {
        // Upload files
        $imagePath = null;
        $pdfPath = null;

        if (isset($data['image'])) {
            $imagePath = uploadFile($data['image'], "images/MembershipApplications"); // public disk by default
        }

        if (isset($data['pdf'])) {
            $pdfPath = uploadFile($data['pdf'], "MembershipApplications_CV"); // public disk by default
        }

        $user = auth()->user();

        // Create record in database
        $application = MembershipApplication::create([
            'user_id' => $user->id,
            'image_path' => $imagePath,
            'pdf_path' => $pdfPath,
            'status' => 'pending',
        ]);

        return $application;
    }


    /**
     * Update the specified membership application
     *
     * @param array $data
     * @param string $id
     * @return MembershipApplication
     */
    public function updateApi(array $data, string $id)
    {
        $membershipApplication = MembershipApplication::findOrFail($id);

        // Upload files
        $imagePath = $membershipApplication->image_path;
        $pdfPath = $membershipApplication->pdf_path;

        if (isset($data['image'])) {
            $imagePath = uploadFile($data['image'], "images/MembershipApplications"); // public disk by default
        }

        if (isset($data['pdf'])) {
            $pdfPath = uploadFile($data['pdf'], "MembershipApplications_CV"); // public disk by default
        }

        // Update the application record
        $membershipApplication->update([
            'image_path' => $imagePath,
            'pdf_path' => $pdfPath,
        ]);

        return $membershipApplication;
    }

    /**
     *  Delete the specified membership application
     * 
     *  @param string $id The membership application id to find and delete
     *  @return bool|null True if the membership application was deleted, false otherwise
     */
    public function deleteApi(string $id)
    {
        try {
            $application = MembershipApplication::findOrFail($id);
            return $application->delete();
        } catch (ModelNotFoundException $e) {

            return false;
        }
    }

    /**
     * Update the status of the specified membership application
     * 
     * @param array $data
     * @param string $id
     * @return bool 
     */
    public function updateStatus(array $data, string $id)
    {
        $application = MembershipApplication::findOrFail($id);

        if ($data['status'] === 'accept') {

            $application->status = 'accepted';
            ($application->user)->assignRole('trainer');
        } else {

            $application->status = 'declined';
        }

        return $application->save();
    }

    /**
     * Display the specified membership application
     *
     * @param string $id The membership application id to find
     * @return MembershipApplication
     */
    public function show(string $id)
    {
        return MembershipApplication::findOrFail($id);
    }

    /**
     *  Delete the specified membership application
     * 
     *  @param string $id The membership application id to find and delete
     *  @return bool|null True if the membership application was deleted, false otherwise
     */
    public function delete(string $id)
    {
        $application = MembershipApplication::findOrFail($id);

        return $application->delete();
    }

    /**
     * Get all Membership Applications after applying filters
     * 
     * @param array $data The data containing filter data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator The paginated list of Membership Applications
     */
    public function getAllMembershipApplicationsAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $memberships = MembershipApplication::whereHas(
            'user',
            function ($query) {
                $query->whereNull('deleted_at');
            }
        )->when($data['name'] ?? null, function ($query, $name) {

            return $query->UserName($name);
        })->paginate($entries_number)->appends(request()->except('page'));

        return $memberships;
    }
}
