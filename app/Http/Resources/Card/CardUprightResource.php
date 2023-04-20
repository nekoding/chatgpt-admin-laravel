<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardUprightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $default = ['default' => $this->uprightLang ? $this->uprightLang->default : $this->upright];
        // $translates = $this->uprightLang->translates->pluck('text', 'lang_code');

        $translates = $this->uprightLang->translates?->map(fn($item) => ['locale' => $item->text])->first() ?? ['locale' => null];

        return [
            ...$default,
            ...$translates
        ];
    }
}
