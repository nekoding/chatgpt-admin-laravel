<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'title_id',
        'default'
    ];

    public function translates(): HasMany
    {
        return $this->hasMany(LanguageTranslation::class, 'lang_id', 'id');
    }
}
