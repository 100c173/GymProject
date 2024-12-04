<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembershipApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'image'  => $this->image_path , 
            'pdf'    => $this->pdf_path,
            'message' => $this->status == 'pending' ? 'Your request is being processed.' : $this->status,
        ];
    }
}
