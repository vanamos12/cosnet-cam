<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class MoreThanXYears implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $min_age = config('cosnet.member_min_age');
        if (Carbon::parse($value)->age < $min_age){
            $fail("You must must be over $min_age years old.");
        }
    }
}
