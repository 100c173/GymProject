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
    public function index(Request $request)
    {
        $q = PlanType::query();

        $entries_number = $request->input('entries_number', 10);

        if ($request->filled('name')) {
            $q->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $plan_types = $q->paginate($entries_number)->appends($request->except('page'));
        return view('new-dashboard.plan_type.list_plan_types', compact('plan_types'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanType $plan_type)
    {
        //
        return view('new-dashboard.plan_type.show_plan_type', [
            'plan_type' => $plan_type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('new-dashboard.plan_type.create_plan_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanTypeRequest $request)
    {
        $plan_type = PlanType::create([
            'name' => $request->name,
        ]);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan_type, 'Plan type created successfully.', 'Failed to Create plan type.');

        return redirect()->route('plan_types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanType $plan_type)
    {
        return view('new-dashboard.plan_type.edit_plan_type', [
            'plan_type' => $plan_type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanType $plan_type)
    {
        $plan_type = $plan_type->update([

            'name' => $request->name,
        ]);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan_type, 'Plan type updated successfully.', 'Failed to update plan type.');

        return redirect()->route('plan_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanType $plan_type)
    {
        $plan_type =  $plan_type->delete();

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan_type, 'Plan type Deleted successfully.', 'Failed to Delete plan type.');

        return redirect()->route('plan_types.index');
    }
}
