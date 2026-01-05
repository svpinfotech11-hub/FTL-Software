<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDelete extends Model
{
     protected $fillable = [
        'deleted_by', 'user_id', 'user_name', 'user_email', 'deleted_at'
    ];

    public $timestamps = true;
}
