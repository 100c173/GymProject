<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServicesResource;
use Illuminate\Support\Facades\Validator;

class services extends Controller
{

    use ApiResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(){

        $services=Service::all();

        return $this->successResponse('service has been successfully retrieved.' ,ServicesResource::collection($services));

    }

    public function store(ServiceRequest $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if($validate->fails()){

            return $this->errorResponse('Validation Error!' ,$validate->errors(),403);

        }
        $services = Service::create([
            'name' => $request->name,
            'description' => $request->description,
           
        ]);
        return $this->successResponse('service has been successfully added.' , new ServicesResource($services),201);
    }

    public function show(string $id)
    {
     
        $service=Service::findorfail($id);

        return $this->successResponse('service has been successfully returned.' , new ServicesResource($service));

    }

    public function update(ServiceRequest $request,string $id)
    {
     
        $service=Service::findorfail($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if($validate->fails()){
            return $this->errorResponse('Validation Error!' ,$validate->errors(),403);

        }
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
           
        ]);
        return $this->successResponse('service has been successfully updated.' , new ServicesResource($service));
    }


    public function destroy(string $id)
    {
     
        $service=Service::findorfail($id);
        $service->delete();
        return $this->successResponse('service has been successfully deleted.');

    }

}
