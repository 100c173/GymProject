<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;

class Services extends Controller
{
    public function index()
    {

        $services = Service::all();
        return response($services, 200, ['response returned succsesfully']);
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
