<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => \App\Http\Resources\Card\CardTitleResource::make($this),
            'upright'       => \App\Http\Resources\Card\CardUprightResource::make($this),
            'reversed'      => \App\Http\Resources\Card\CardReversedResource::make($this),
        ];
    }
}
