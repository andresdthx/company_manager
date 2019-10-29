<?php

namespace App;

use Illuminate\Foundation\Auth\Employee as Authenticatable;

class Employee extends Authenticatable
{
    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function show($role){
        return $this->roles()->where('name', $role)->count();
    }

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone',
    ];

    public function authorizeRoles($roles){
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized');
    }

    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if ($this->roles()->where('name', $role)->count() == 1) {
            return true;
        }
        return false;
    }
}
