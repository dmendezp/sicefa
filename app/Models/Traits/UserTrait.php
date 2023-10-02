<?php

namespace App\Models\Traits;

trait UserTrait {

    public function havePermission($permission){
        foreach($this->roles as $role){

            if($role['full_access']=='Si'){
                return true;
            }

            foreach($role->permissions as $perm){
                if($perm['slug']==$permission){
                    return true;
                }
            }

        }
        return false;
    }

}
