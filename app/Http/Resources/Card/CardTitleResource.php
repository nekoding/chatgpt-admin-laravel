<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardTitleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $default = ['default' => $this->titleLang ? $this->titleLang->default : $this->title];
        $translates = $this->titleLang->translates->pluck('text', 'lang_code');

        return [
            ...$default,
            ...$translates
        ];
    }
}
