<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanType;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use App\Services\PlanService;

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
     * PlanController constructor
     *
     * @param PlanService $planService
     */
    public function __construct(PlanService $planService)
    {
        // Apply the auth middleware to ensure the user is authenticated
        $this->middleware(['auth']);

        $this->middleware('unique.plan')->only('store');
        
        // Inject the PlanService to handle plan-related logic
        $this->planService = $planService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $plan_types = PlanType::all();

        $plans = $this->planService->getAllPlansAfterFiltering($request);

        return view('new-dashboard.plan.list_plans',[
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
        return view('new-dashboard.plan.create_plan',[
            'plan_types' => $plan_types
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
       $plan = $this->planService->create($request);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan, 'Plan created successfully.', 'Failed to Create plan.');

        return redirect()->route('plans.index');
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
     */
    public function update(Request $request, Plan $plan)
    {
        $plan = $this->planService->update($request,$plan);

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan, 'Plan updated successfully.', 'Failed to update plan.');
        
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
       $plan = $plan->delete();

        // using the method from FlashMessageHelper to alert the user about success or faild
        flashMessage($plan, 'Plan Deleted successfully.', 'Failed to Delete plan.');

        return redirect()->route('plans.index');
    }

}
