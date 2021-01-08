<?php

namespace App\Http\Resources\Subcription;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSubcriptionResource extends JsonResource
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
            'subcription_status' => $this->SubcriptionType->type
        ];
    }
}
