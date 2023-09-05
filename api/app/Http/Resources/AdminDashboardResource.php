<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminDashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $policies = $this->policies->sortByDesc('last_operation');
        $lastOperations = $policies->map(function ($policy) {
            $lastOperation = $policy->last_operation;

            // Проверяем, является ли $lastOperation строкой и преобразуем ее в объект Carbon, если нужно
            if (is_string($lastOperation)) {
                $lastOperation = Carbon::parse($lastOperation);
            }

            return [
                'id' => $policy->id,
                'last_operation' => $lastOperation->format('d/m/Y'),
            ];
        })->toArray();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'last_operations' => $lastOperations,
            'policies'=>$this->policies,
            'status' => true,
        ];
    }
}
