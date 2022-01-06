<?php 

namespace App\Actions;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

Trait HasRoleAction 
{
    /**
     * @param \App\Models\Role|string $role
     * @return boolean
     */
    public function hasRole(Role|string $role): bool
    {
        if (is_string($role)) {
            return Role::find($this->role->role_id)->name === $role;
        }

        return $this->role->role_id === $role->id;
    }
}