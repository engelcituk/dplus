<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    use HandlesAuthorization;

    
    public function view(User $user, Permission $permission)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View permissions');
        
    }
  
    public function update(User $user, Permission $permission)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update permissions');
    }

    
}
