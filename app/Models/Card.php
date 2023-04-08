<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'image_path',
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
}
