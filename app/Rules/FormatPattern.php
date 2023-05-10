<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FormatPattern implements ValidationRule
{
    public function __construct(
        public string $patern,
        public string $message
    ) {
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match($this->patern, $value, $match);
        if (count($match) < 1) {
            $fail('The :attribute must be contain format ' . $this->message);
        }
    }
}
