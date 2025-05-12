<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id_type' => $this->id_type,
            'id_no' => $this->id_no,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'address' => $this->address,
        ];
    }
}
