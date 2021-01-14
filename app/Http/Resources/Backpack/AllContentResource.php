<?php

namespace App\Http\Resources\Backpack;

use App\Utils\AppAsset;
use Illuminate\Http\Resources\Json\JsonResource;

class AllContentResource extends JsonResource
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'category' =>  $this->Category->title,
            'thumbnail' => $this->Category->image_path,
            'description' => $this->description,
            'videoPath' => AppAsset::url(AppAsset::VIDEO, $this->video_path),
            'title' => $this->title,
            'unlock' => backpack_user()->UserSubcription->SubcriptionType->order <= $this->SubcriptionType->order,
            'subscriptionType' => $this->SubcriptionType->type,
        ];
    }
}
