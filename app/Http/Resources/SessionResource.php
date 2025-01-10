<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return  [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'status' => $this->status,
        'max_members' => $this->max_members,
       
    ];
    }
}
