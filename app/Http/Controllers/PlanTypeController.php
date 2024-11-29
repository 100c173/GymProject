<?php

namespace App\Http\Controllers;

use App\Models\PlanType;
use Illuminate\Http\Request;
use App\Http\Requests\PlanTypeRequest;

class PlanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plan_types = PlanType::all();
        return view('dashboard.manager.planeType.list', compact('plan_types'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanType $plan_type)
    {
        //
        return view('dashboard.manager.planeType.show',[
            'plan_type' => $plan_type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.manager.planeType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanTypeRequest $request)
    {
        PlanType::create([

            'name' => $request->name,
        ]);
        return redirect()->route('plan_types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanType $plan_type)
    {
        return view('dashboard.manager.planeType.edit', [
            'plan_type' => $plan_type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanType $plan_type)
    {
        $plan_type->update([

            'name' => $request->name,
        ]);
        return redirect()->route('plan_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanType $plan_type)
    {
        $plan_type->delete();
        return redirect()->route('plan_types.index');
    }
}
