<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'amount' => $this->total_amount,
            'due_on' => $this->due_on,
            'status' => $this->status_value,
            'payments' => PaymentResource::collection($this->whenLoaded('payments'))
        ];
    }
}
