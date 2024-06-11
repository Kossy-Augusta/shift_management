<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;

class TodayorAfter implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // conver the date into a carbon instance
        $date = Carbon::parse($value);
        if (!$date->isToday() && !$date->isAfter(Carbon::Today()))
        {
            $fail("The $attribute must be today or a date after today.");
        }
    }
}
