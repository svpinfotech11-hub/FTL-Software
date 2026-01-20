<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
