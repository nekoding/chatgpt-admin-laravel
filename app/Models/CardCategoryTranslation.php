<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardCategoryTranslation extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'card_cat_id',
        'lang_code',
        'text',
        'description'
    ];
}
