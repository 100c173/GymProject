<?php

namespace App\Services;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\PlanType;
use Illuminate\Http\Request;

class PlanTypeService
{

    public function getAllPlanTypes()
    {
        return PlanType::all();
    }

    /**
     * To Create a new plan type
     * 
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $plan = PlanType::create([
            'name' => $data['name'],
        ]);

        return $plan;
    }

    /**
     * To Edit an plan type
     * 
     * @param array $data The update data
     * @param PlanType $planType The plan type to update
     */
    public function update(array $data, PlanType $planType)
    {
        $planType->update($data);

        return $planType;
    }

    /**
     *  Delete the specified plan type
     * 
     *  @param PlanType $planType The plan type to delete
     *  @return bool|null True if the plan type was deleted, false otherwise
     */
    public function delete(PlanType $planType)
    {

        return $planType->delete();
    }

    /**
     * Get paginated plan types with applied filters
     *
     * This function retrieves a paginated list of plan types from the PlanType model
     * applying filters based on the request parameters
     * The filters include:
     * - Plan Type name ('name')
     *
     * The function returns the filtered results paginated with 10 items per page
     *
     * @param array $data The incoming data containing filter parameters
     * @return LengthAwarePaginator The paginated list of filtered plan types
     */
    public function getAllPlanTypesAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $planTypes = PlanType::query()
            ->when(
                isset($data['name']),
                function ($query) use ($data) {
                    return  $query->SearchByName($data['name']);
                }
            )->paginate($entries_number)->appends(request()->except('page'));

        return $planTypes;
    }
}
