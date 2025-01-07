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
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $plan = Plan::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'with_trainer' => $data['with_trainer'],
            'period' => $data['period'],
            'plan_type_id' => $data['plan_type_id'],
        ]);

        return $plan;
    }

    /**
     * To Edit an plan
     * 
     * @param array $data The update data
     * @param Plan $plan The plan to update
     */
    public function update(array $data, Plan $plan)
    {
        $plan->update($data);

        return $plan;
    }

    /**
     *  Delete the specified plan
     * 
     *  @param Plan $plan The plan to delete
     *  @return bool|null True if the plan was deleted, false otherwise
     */
    public function delete(Plan $plan)
    {

        return $plan->delete();
    }

    /**
     * Get paginated plans with applied filters
     *
     * This function retrieves a paginated list of plans from the Plan model
     * applying filters based on the request parameters
     * The filters include:
     * - Plan name ('name')
     * - Minimum price ('min_price')
     * - Maximum price ('max_price')
     * - With trainer on not ('with_trainer')
     * - Plan type ('plan_type')
     *
     * The function returns the filtered results paginated with 10 items per page
     *
     * @param array $data The incoming data containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered plans
     */
    public function getAllPlansAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $plans = Plan::query()
            ->when(
                isset($data['name']),
                function ($query) use ($data) {
                    return  $query->SearchByName($data['name']);
                }
            )
            ->when(
                isset($data['min_price']),
                function ($query) use ($data) {
                    return  $query->MinPrice($data['min_price']);
                }
            )
            ->when(
                isset($data['max_price']),
                function ($query) use ($data) {
                    return  $query->MaxPrice($data['max_price']);
                }
            )
            ->when(
                isset($data['with_trainer']),
                function ($query) use ($data) {
                    return  $query->WithTrainer($data['with_trainer']);
                }
            )
            ->when(
                isset($data['plan_type']),
                function ($query) use ($data) {
                    return  $query->PlanType($data['plan_type']);
                }
            )->paginate($entries_number)->appends(request()->except('page'));

        return $plans;
    }
}
