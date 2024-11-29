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

        // Inject the UserService to handle user-related logic
        $this->planService = $planService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $plans = Plan::all();

        return view('dashboard.manager.plane.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans = PlanType::all();
        return view('dashboard.manager.plane.create', compact('plans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
       $this->planService->create($request);

        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('dashboard.manager.plane.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        $plans = PlanType::all();
        return view('dashboard.manager.plane.edit', compact('plan', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $this->planService->update($request,$plan);
        
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {

        if (!$request) {
            $plans = Plan::all();
            return view('dashboard.manager.plane.index', compact('plans'));
        } else {
            $plans = Plan::where('period', $request->search)->orWhere('price', '<=', $request->search)
                ->orWhereHas('PlanType', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->get();
            return view('dashboard.manager.plane.index', compact('plans'));
        }
        return view('dashboard.manager.plane.index', compact('plans', 'search'));
    }
}
