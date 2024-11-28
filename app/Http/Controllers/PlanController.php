<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanType;
use Illuminate\Http\Request;
use App\Http\Requests\PlanControllerRequest;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
        $plans=Plan::all();

      return view('dashboard.manager.plane.index',compact('plans'));
    
    }
    public function search(Request $request)
    {
        
        if(!$request){
            $plans = Plan::all();
            return view('dashboard.manager.plane.index',compact('plans'));
        }else{
            $plans = Plan::where( 'period',$request->search)->orWhere('price','<=',$request->search)
            ->orWhereHas('PlanType', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get();
            return view('dashboard.manager.plane.index',compact('plans'));
        }
        return view('dashboard.manager.plane.index',compact('plans','search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plans=PlanType::all();
        return view('dashboard.manager.plane.create',compact('plans'));
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanControllerRequest $request)
    {
             Plan::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'with_trainer'=>$request->input('with_trainer'),
            'period'=>$request->input('period'),
            'plan_type_id'=>$request->input('plan_type_id'),
                    ]);

          return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('dashboard.manager.plane.show',compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        $plans=PlanType::all();
        return view('dashboard.manager.plane.edit',compact('plan','plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Plan $plan)
    {
       $plan->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'with_trainer'=>$request->input('with_trainer'),
            'period'=>$request->input('period'),
            'plan_type_id'=>$request->input('plan_type_id'),
                    ]);

         
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
}
