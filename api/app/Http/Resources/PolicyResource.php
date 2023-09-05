<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PolicyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'fullname'=>$this->fullName,
            'plan_reference'=>$this->plan_reference,
            'investment_house'=>$this->investment_house,
            'last_operation'=>$this->last_operation
        ];
    }
}
