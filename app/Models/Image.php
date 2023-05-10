<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'filename',
        'image_path',
        'disk',
        'mime_type',
        'image_size',   // bytes
        'model_type',
        'model_id',
        'data',         // additional json column if need add new metadata
        'file_extension',
    ];

    protected $casts = [
        'data' => 'array',
        'image_size' => 'int'
    ];

    /**
     * Get the model that the image belongs to.
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }
}
