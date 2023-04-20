<?php

namespace App\Http\Resources\Language;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'title_id'  => $this->title_id,
            'lang'      => [
                'default'   => $this->default,
            ]
        ];

        $data['lang'] += $this->translates?->map(fn($item) => ['locale' => $item->text])->first() ?? ['locale' => null];

        return $data;
    }
}
