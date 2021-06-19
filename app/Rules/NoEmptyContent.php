<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoEmptyContent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strlen(preg_replace('/\s+/u',"",str_replace("&nbsp;",'',strip_tags($value)))) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The content must not be empty.';
    }
}
