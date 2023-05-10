<?php

namespace App\Http\Resources\Images;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'filename'          => $this->filename,
            'image_path'        => $this->image_path,
            'disk'              => $this->disk,
            'mime_type'         => $this->mime_type,
            'image_size'        => $this->image_size,
            'data'              => $this->data,
            'file_extension'    => $this->file_extension,
            'full_path'         => asset('/storage/' . $this->image_path)
        ];
    }
}
