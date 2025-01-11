<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanTypeFilterRequest;
use App\Models\PlanType;
use Illuminate\Http\Request;
use App\Http\Requests\PlanTypeRequest;
use App\Services\PlanTypeService;

class PlanTypeController extends Controller
{
    /**
     * Service to handle planType-related logic 
     * and separating it from the controller
     * 
     * @var PlanTypeService
     */
    protected $planTypeService;

    /**
     * PlanTypeController constructor
     *
     * @param PlanTypeService $planTypeService
     */
    public function __construct(PlanTypeService $planTypeService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the PlanTypeService to handle planType-related logic
        $this->planTypeService = $planTypeService;
    }

    /**
     * Display a listing of the plan types after applying filters
     * 
     * @param PlanTypeFilterRequest $request The request object containing filter data 
     * @return View The view displaying the list of plan types
     */
    public function index(PlanTypeFilterRequest $request)
    {
        $validated = $request->validated();
        $plan_types = $this->planTypeService->getAllPlanTypesAfterFiltering($validated);

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
     * 
     * @param PlanTypeRequest $request To store the plan type according to the conditions used
     * in this form request
     */
    public function store(PlanTypeRequest $request)
    {
        $validated = $request->validated();
        $plan_type = $this->planTypeService->create($validated);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan_type, 'Plan type created successfully.', 'Failed to Create plan type.');

        return redirect()->route('plan_types.' . $request->redirect_to);
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
     * 
     * @param PlanTypeRequest $request To update the plan according to the conditions used
     * in this form request
     */
    public function update(PlanTypeRequest $request, PlanType $plan_type)
    {
        $validated = $request->validated();
        $plan_type = $this->planTypeService->update($validated, $plan_type);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan_type, 'Plan type updated successfully.', 'Failed to update plan type.');

        return redirect()->route('plan_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanType $plan_type)
    {
        $plan_type =  $this->planTypeService->delete($plan_type);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan_type, 'Plan type Deleted successfully.', 'Failed to Delete plan type.');

        return redirect()->route('plan_types.index');
    }
}
