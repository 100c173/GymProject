<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'with_trainer' => $this->with_trainer,
            'period' => $this->period,
            'planType'=>  new PlanTypeResource($this->whenLoaded('planType')),
            'sessions' => SessionResource::collection($this->sessions)
           
        ];
       /* if ($request->routeIs('plansWithSession')) {
            $data['sessions'] = SessionResource::collection($this->sessions);
        }*/
    }
}
