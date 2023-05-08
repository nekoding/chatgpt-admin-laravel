<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromptCategory extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'title_id',
        'default'
    ];

    public function translates(): HasMany
    {
        return $this->hasMany(PromptCategoryTranslation::class, 'lang_id', 'id');
    }
}
