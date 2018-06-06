<?php

namespace App\Models;

use App\Models\Traits\ApiScopes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Category;
use App\Models\Permission;

class User extends Authenticatable
{
    use Notifiable;
    use ApiScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hasDefinePrivilege($permission)
    {
        //TODO: check role
        return false;
    }

    public function isAccessAdmin()
    {
        //TODO: check admin
        return $this->id == 1;
    }

    public function abilityCategories()
    {
        return $this->belongsToMany(Category::class,'user_ability_categories', 'user_id', 'category_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions','user_id', 'permission_id');
    }

    public function hasPermission($permissionSlug)
    {
        return $this->permissions()->where('slug', $permissionSlug)->first() !== null;
    }
}
