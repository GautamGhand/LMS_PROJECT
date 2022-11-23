<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    CONST ADMIN=1;
    CONST SUB_ADMIN=2;
    CONST TRAINER=3;
    CONST EMPLOYEE=4;

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function scopeNotAdmin()
    {
        return $this->where('slug','!=','admin');
    }

}
