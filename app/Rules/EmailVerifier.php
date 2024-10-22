<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class EmailVerifier implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!verifyEmailAddress($value)) {
            $fail('Verification failed for this :attribute address.');
        }
    }
}
