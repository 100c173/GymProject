<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanFilterRequest;
use App\Models\Plan;
use App\Models\PlanType;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use App\Services\PlanService;
use App\Services\PlanTypeService;

class PlanController extends Controller
{

    /**
     * Service to handle plan-related logic 
     * and separating it from the controller
     * 
     * @var PlanService
     */
    protected $planService;

    /**
     * Service to handle planType-related logic 
     * and separating it from the controller
     * 
     * @var PlanTypeService
     */
    protected $planTypeService;

    /**
     * PlanController constructor
     *
     * @param PlanService $planService
     * @param PlanTypeService $planTypeService
     */
    public function __construct(PlanService $planService, PlanTypeService $planTypeService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        // Inject the PlanService to handle plan-related logic
        $this->planService = $planService;

        // Inject the PlanTypeService to handle planType-related logic
        $this->planTypeService = $planTypeService;
    }

    /**
     * Display a listing of the plans after applying filters
     * 
     * @param PlanFilterRequest $request The request object containing filter data 
     * @return View The view displaying the list of plans
     */
    public function index(PlanFilterRequest $request)
    {
        $plan_types = $this->planTypeService->getAllPlanTypes();
        $validated = $request->validated();
        $plans = $this->planService->getAllPlansAfterFiltering($validated);

        return view('new-dashboard.plan.list_plans', [
            'plan_types' => $plan_types,
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plan_types = PlanType::all();
        return view('new-dashboard.plan.create_plan', [
            'plan_types' => $plan_types
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * 
     * @param PlanRequest $request To store the plan according to the conditions used
     * in this form request
     */
    public function store(PlanRequest $request)
    {
        $validated = $request->validated();
        $plan = $this->planService->create($validated);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan, 'Plan created successfully.', 'Failed to Create plan.');

        return redirect()->route('plans.' . $request->redirect_to);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('new-dashboard.plan.show_plan', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        $plan_types = PlanType::all();
        return view('new-dashboard.plan.edit_plan', compact('plan', 'plan_types'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param PlanRequest $request To update the plan according to the conditions used
     * in this form request
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $validated = $request->validated();
        $plan = $this->planService->update($validated, $plan);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan, 'Plan updated successfully.', 'Failed to update plan.');

        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan = $this->planService->delete($plan);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan, 'Plan Deleted successfully.', 'Failed to Delete plan.');

        return redirect()->route('plans.index');
    }
}
