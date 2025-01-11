<?php

namespace App\Services;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceService
{
    /**
     * For create a new service
     * 
     * @param array $data To Create the service
     */
    public function create(array $data)
    {
        $service = Service::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $service;
    }

    /**
     * For update a service
     * 
     * @param array $data To Update the service
     * @param Service $service To know which service will be updated
     */
    public function update(array $data, Service $service)
    {
        $service = $service->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $service;
    }

    /**
     *  Delete the specified service
     * 
     *  @param Service $service The service to delete
     *  @return bool|null True if the service was deleted, false otherwise
     */
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
     * @param array $data The incoming data containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered services
     */
    public function getAllServicesAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $services = Service::query()
            ->when(
                isset($data['name']),
                function ($query) use ($data) {
                    return $query->SearchName($data['name']);
                }
            )->paginate($entries_number)->appends(request()->except('page'));

        return $services;
    }
    public function getAllServices()
    {
        return Service::all(); 
    }
}
