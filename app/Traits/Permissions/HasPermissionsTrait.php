<?php
namespace App\Traits\Permissions;

use App\Models\{Role,Permission};

trait HasPermissionsTrait
{

    /**
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role)
        {
            if ($this->roles->contains('name',$role))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return mixed
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) ||  $this->hasPermission($permission);
    }

    /**
     * Check the only Permission
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name',$permission->name)->count();
    }

    /**
     * Check the roles and Permission for user
     * @param $permission
     * @return bool
     */
    protected function hasPermissionThroughRole($permission)
    {
        /*
         * Iterate each permissions role
         * */
        foreach ($permission->roles as $role)
        {

            if ($this->roles->contains($role))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Give Permissions to the User
     * @param mixed ...$permissions
     * @return HasPermissionsTrait
     */
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getPermissions(array_flatten($permissions));
        if ($permissions === null)
        {
            return $this;
        }

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Withdraw Permissions from User
     * @param mixed ...$permissions
     * @return $this
     */
    public function withDrawPermissionTo(...$permissions)
    {
        $permissions = $this->getPermissions(array_flatten($permissions));
        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * Get Permission Collections by Providing Permission
     * @param array $permissions
     * @return mixed
     */
    protected function getPermissions(array $permissions)
    {
        return Permission::whereIn('name',$permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     * @return HasPermissionsTrait
     */
    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();


        return $this->givePermissionTo($permissions);
    }

     /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

}
