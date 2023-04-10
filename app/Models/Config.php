<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'key',
        'value'
    ];

    const OPENAI_MODEL = [
        "GPT432K0314"             => "gpt-4-32k-0314",
        "GPT432K"                 => "gpt-4-32k",
        "GPT40314"                => "gpt-4-0314",
        "GPT4"                    => "gpt-4",
        "GPT3Dot5Turbo0301"       => "gpt-3.5-turbo-0301",
        "GPT3Dot5Turbo"           => "gpt-3.5-turbo",
        "GPT3TextDavinci003"      => "text-davinci-003",
        "GPT3TextDavinci002"      => "text-davinci-002",
        "GPT3TextCurie001"        => "text-curie-001",
        "GPT3TextBabbage001"      => "text-babbage-001",
        "GPT3TextAda001"          => "text-ada-001",
        "GPT3TextDavinci001"      => "text-davinci-001",
        "GPT3DavinciInstructBeta" => "davinci-instruct-beta",
        "GPT3Davinci"             => "davinci",
        "GPT3CurieInstructBeta"   => "curie-instruct-beta",
        "GPT3Curie"               => "curie",
        "GPT3Ada"                 => "ada",
        "GPT3Babbage"             => "babbage",
    ];
}
