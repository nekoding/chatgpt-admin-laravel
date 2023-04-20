<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardReversedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $default = ['default' => $this->reversedLang ? $this->reversedLang->default : $this->reversed];
        // $translates = $this->reversedLang->translates->pluck('text', 'lang_code');

        $translates = $this->reversedLang->translates?->map(fn($item) => ['locale' => $item->text])->first() ?? ['locale' => null];

        return [
            ...$default,
            ...$translates
        ];
    }
}
