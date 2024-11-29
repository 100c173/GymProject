<?php

namespace App\Services;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanService
{

    /**
     * To Create a new plan
     * 
     * @param PlanRequest
     */
    public function create(PlanRequest $request)
    {
       $plan = Plan::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'with_trainer' => $request->input('with_trainer'),
            'period' => $request->input('period'),
            'plan_type_id' => $request->input('plan_type_id'),
        ]);
        return $plan;
    }

    /**
     * To Edit a plan
     * 
     * @param Request
     * @param Plan
     */
    public function update(Request $request, Plan $plan)
    {
        $plan->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'with_trainer' => $request->input('with_trainer'),
            'period' => $request->input('period'),
            'plan_type_id' => $request->input('plan_type_id'),
        ]);
        
        return $plan;
    }
}
