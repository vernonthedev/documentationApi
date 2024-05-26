<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Modify the output for the json api response
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "email"=> $this->email,
            "type"=> $this->type,
            "address"=> $this->address,
            "city"=> $this->city,
            "state"=> $this->state,
            "postalCode"=> $this->postal_code,
            //incase the user also wants the invoices, thats when we also return them
            "invoices"=> InvoiceResource::collection($this->whenLoaded("invoices")),
        ];
    }
}
