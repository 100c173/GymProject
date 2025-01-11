<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\ServiceService;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;

class Services extends Controller
{protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }  
      public function index()
    {

        $services = $this->serviceService->getAllServices();
        if (!$services) {
            return $this->errorResponse('Faild');
        }
        return $this->successResponse('All Services retrieved successfully', ServiceResource::collection($services));
      }

    public function store(ServiceRequest $request)
    {
        $services = Service::create([
            'name' => $request->name,
            'description' => $request->description,

        ]);
        return response($services, 201, ['created succsesfully']);
    }

    public function show(string $id)
    {

        $service = Service::findorfail($id);

        return response($service, 200, ['element returned succsesfully']);
    }

    public function update(ServiceRequest $request, string $id)
    {

        $service = Service::findorfail($id);

        $service->update([
            'name' => $request->name,
            'description' => $request->description,

        ]);
        return response($service, 200, ['updated succsesfully']);
    }


    public function destroy(string $id)
    {

        $service = Service::findorfail($id);
        $service->delete();
        return response(200, ['element deleted succsesfully']);
    }
}
