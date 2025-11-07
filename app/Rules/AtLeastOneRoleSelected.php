<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AtLeastOneRoleSelected implements Rule
{
    public function passes($attribute, $value)
    {
        return !empty(array_filter($value));
    }

    public function message()
    {
        return __('validation.at_least_one_role');
    }
}
