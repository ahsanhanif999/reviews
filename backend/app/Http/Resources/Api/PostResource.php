<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\CompanyResource;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\Api\TagResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'rating' => $this->rating,
            'tags' => new TagResource($this->post_tags),
            'user' => new UserResource($this->creator),
            'company' => new CompanyResource($this->company),
        ];
    }
}
