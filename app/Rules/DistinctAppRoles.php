<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\SICA\Entities\Role;

class DistinctAppRoles implements Rule
{
    public function passes($attribute, $value)
    {
        $appIds = Role::whereIn('id', $value)->pluck('app_id')->toArray();
        $uniqueAppIds = array_unique($appIds);
        return count($appIds) === count($uniqueAppIds);
    }

    public function message()
    {
        return __('validation.distinct_app_roles');
    }
}
