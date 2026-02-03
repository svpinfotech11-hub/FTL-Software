<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Permission;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name','email','phone','pan','gst',
        'country','state','city','address',
        'password','phone_verified','email_verified', 'role', 'status', 'created_by', 'branch_id', 'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

        protected $dates = ['deleted_at'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function company()
    {
        return $this->hasOne(AddCompany::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
                        ->where(function($q) {
                                $q->whereNull('roles.user_id')
                                    ->orWhere('roles.user_id', $this->created_by)
                                    ->orWhere('roles.user_id', $this->id);
                        });
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $r = Role::firstOrCreate(['name' => $role]);
            $this->roles()->syncWithoutDetaching([$r->id]);
            return;
        }

        if ($role instanceof Role) {
            $this->roles()->syncWithoutDetaching([$role->id]);
            return;
        }
    }

    public function syncRoles(array $roles)
    {
        $roleIds = [];
        foreach ($roles as $r) {
            if (is_string($r)) {
                $role = Role::firstOrCreate(['name' => $r]);
                $roleIds[] = $role->id;
            } elseif ($r instanceof Role) {
                $roleIds[] = $r->id;
            }
        }
        $this->roles()->sync($roleIds);
    }

    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName) || ($this->role === $roleName);
    }

    public function hasAnyRole($roles)
    {
        foreach ((array) $roles as $r) {
            if ($this->hasRole($r)) return true;
        }
        return false;
    }

    public function getRoleNames()
    {
        return $this->roles->pluck('name');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }

    public function hasPermission($permission)
    {
        // Admin and super_admin have all permissions (check via roles)
        if ($this->hasAnyRole(['admin', 'super_admin'])) {
            return true;
        }

        // Check direct permissions
        if ($this->permissions->contains('name', $permission)) {
            return true;
        }

        // Check user's assigned permissions through roles
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $userPermission) {
                if ($userPermission->name === $permission) {
                    return true;
                }
            }
        }

        return false;
    }

    public function hasAnyPermission($permissions)
    {
        // Admin and super_admin have all permissions (check via roles)
        if ($this->hasAnyRole(['admin', 'super_admin'])) {
            return true;
        }

        $permissions = is_array($permissions) ? $permissions : [$permissions];

        // Check direct permissions
        if ($this->permissions->whereIn('name', $permissions)->count() > 0) {
            return true;
        }

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $userPermission) {
                if (in_array($userPermission->name, $permissions)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function hasAllPermissions($permissions)
    {
        // Admin and super_admin have all permissions (check via roles)
        if ($this->hasAnyRole(['admin', 'super_admin'])) {
            return true;
        }

        $permissions = is_array($permissions) ? $permissions : [$permissions];
        $userPermissions = [];

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $userPermission) {
                $userPermissions[] = $userPermission->name;
            }
        }

        foreach ($permissions as $permission) {
            if (!in_array($permission, $userPermissions)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the branch that the user belongs to.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
