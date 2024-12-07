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

    public function getAllPlansAfterFiltering(Request $request)
    {

        $q = Plan::query();

        $entries_number = $request->input('entries_number', 10);

        if ($request->filled('name')) {
            $q->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('min_price')) {
            $q->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $q->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('with_trainer')) {
            $q->where('with_trainer', $request->input('with_trainer'));
        }

        if ($request->filled('plan_type_id')) {
            $q->where('plan_type_id', $request->input('plan_type_id'));
        }

        $plans = $q->paginate($entries_number)->appends($request->except('page'));

        return $plans;

    }
}
