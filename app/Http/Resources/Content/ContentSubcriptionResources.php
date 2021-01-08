<?php

namespace App\Http\Resources\Content;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentSubcriptionResources extends JsonResource
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
            'title' => $this->title,
            'author' => $this->User->detail->name,
            'category' => $this->Category->title,
            'subcription_type' => $this->SubcriptionType->type,
            'order' => $this->SubcriptionType->order,
            'pdf' => $this->Category->pdf_path,
            'video' => $this->video_path,
            'description' => $this->description
        ];
    }
}
