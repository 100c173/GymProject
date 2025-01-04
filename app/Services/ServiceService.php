<?php

namespace App\Services;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceService
{
    /**
     * For create a new user
     * 
     * @param ServiceRequest $request To Create the user
     */
    public function create(ServiceRequest $request)
    {
        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $service;
    }

    /**
     * For update a user
     * 
     * @param ServiceRequest $request To Update the user
     * @param User $user To know which user will be updated
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service = $service->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return $service;
    }

    public function delete(Service $service)
    {
        return $service->delete();
    }

    /**
     * getAllServicesAfterFilttering based on request parameters
     *
     * This function retrieves a paginated list of services from the Service model
     * applying filters based on the request parameters. The filters include:
     * - Name ('name'): Filters services by name using a 'like' query
     *
     * @param Request $request The incoming request containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered services
     */
    public function getAllServicesAfterFilttering(Request $request)
    {
        // To define how many rows per page
        $entries_number = $request->input('entries_number', 10);

        $q = Service::query();

        if ($request->filled('name')) {
            $q->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $services = $q->paginate($entries_number);

        return $services;
    }
}
