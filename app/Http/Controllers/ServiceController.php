<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    /**
     * Service to handle service-related logic 
     * and separating it from the controller
     * 
     * @var ServiceService
     */
    protected $serviceService;

    /**
     * ServiceController constructor
     *
     * @param ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the ServiceService to handle service-related logic
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $services = $this->serviceService->getAllServicesAfterFilttering($request);
        return view('new-dashboard.service.list_services', [
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('new-dashboard.service.create_service');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        //
        $service = $this->serviceService->create($request);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($service, 'Service created successfully.', 'Failed to Create service.');
        
       return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
        return view('new-dashboard.service.edit_service',[
            'service' => $service,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        //
       $service = $this->serviceService->update($request, $service);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($service, 'Service updated successfully.', 'Failed to update service.');

        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
       $service = $this->serviceService->delete($service);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($service, 'Service Deleted successfully.', 'Failed to Delete service.');

        return redirect()->route('services.index');
    }
}
