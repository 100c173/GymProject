<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SportEquipment;
use App\Http\Requests\SportEquipmentRequest;

class SportEquipmentController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SportEq=SportEquipment::all();
        return view('',compact('SportEq'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SportEquipmentRequest $request)
    {
       $path= upload_img($request->image_path,'img');
        SportEquipment::create([

            'name'=>$request->name,
            'brand'=>$request->brand,
            'description'=>$request->description,
            'equipment_status'=>$request->equipment_status,
            'image_path'=>$path,

        ]);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SportEquipment $SportEq)
    {
        
        return view('',compact('SportEq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportEquipment $SportEq)
    {

        return view('',compact('SportEq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SportEquipmentRequest $request, SportEquipment $SportEq)
    {
        $SportEq->update([

            'name'=>$request->name,
            'brand'=>$request->brand,
            'description'=>$request->description,
            'equipment_status'=>$request->equipment_status,
            'image_path'=>$request->image_path,

        ]);
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportEquipment $SportEq)
    {
        $SportEq->delete();
        return redirect()->route('index');
    }
}
