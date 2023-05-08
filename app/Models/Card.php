<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'title',
        'upright',
        'reversed',
    ];

    public function titleLang(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'title', 'title_id');
    }

    public function uprightLang(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'upright', 'title_id');
    }

    public function reversedLang(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'reversed', 'title_id');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable', 'model_type', 'model_id');
    }

    public function getPrimaryCardKey(): string
    {
        return 'image_classic';
    }
}
