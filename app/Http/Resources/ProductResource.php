<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
   /**
    * Transform the resource into an array.
    *
    * @return array<string, mixed>
    */
   public function toArray(Request $request): array
   {
      return [
         "id" => $this->id,
         "image_url" => $this->image_url,
         "title" => $this->title,
         "sku" => $this->sku,
         "description" => $this->description,
         "discount" => $this->discount,
         "price" => $this->price,
         "stock" => $this->stock,
         "status" => $this->status,
         "category" => new CategoryResource($this->category),
         "createdBy" => new UserResource($this->createdBy),
         "tags" => TagResource::collection($this->tags)
      ];
   }
}
