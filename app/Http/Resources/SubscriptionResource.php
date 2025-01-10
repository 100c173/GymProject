<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'   => $this->status,
            'plan_id'  => $this->plan_id,
            'user_id'  => $this->user_id,
            'start'    => $this->start,
            'end'      => $this->end,
        ];
    }
}