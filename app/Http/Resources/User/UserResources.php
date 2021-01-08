<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'name' => $this->detail->name,
            'telp' => $this->detail->no_telp,
            'subcription' => $this->UserSubcription->SubcriptionType->type,
            'order' => $this->UserSubcription->SubcriptionType->order,
        ];
    }
}
