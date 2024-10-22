<?php

namespace App\Rules;

use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\InvokableRule;

class PhoneNumberRule implements InvokableRule
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
        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneNumberUtil->parse($value, null);
            $regionCode = $phoneNumberUtil->getRegionCodeForNumber($phoneNumber);
            $possibleType = $phoneNumberUtil->isPossibleNumberForType($phoneNumber, \libphonenumber\PhoneNumberType::MOBILE);

            if (!$possibleType) $fail("The :attribute must be a valid phone number");

            if (!$phoneNumberUtil->isValidNumber($phoneNumber)) $fail("The :attribute must be a valid phone number");

            if (!$phoneNumberUtil->isPossibleNumber($phoneNumber, $regionCode)) $fail("The :attribute must be a valid phone number");

            return true;

        } catch (\libphonenumber\NumberParseException $exception) {
            $message = $exception->getMessage();
            if(Str::contains($message, 'Missing or invalid default region')) {
                $client_readable_message = 'The :attribute must be a valid phone number with a dialing code.';
            } else {
                $client_readable_message = $message;
            }
            $fail($client_readable_message);
        }
    }
}
