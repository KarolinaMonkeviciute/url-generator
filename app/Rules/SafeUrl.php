<?php

namespace App\Rules;

use App\Services\SafeBrowsingService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $safeBrowsing = app(SafeBrowsingService::class);
        if(!$safeBrowsing->check($value)){
            $fail('The :attribute is not a safe url');
        }
    }
}
