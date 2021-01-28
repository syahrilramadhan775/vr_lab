<?php

namespace App\Http\Resources\ErrorException;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorProfileResource extends JsonResource
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
            'status' => 404,
            'text' => 'Data Not Found'
        ];
    }
}
