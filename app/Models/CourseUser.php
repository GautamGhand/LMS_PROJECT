<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use PDO;

class CourseUser extends Pivot
{
    use HasFactory;

    protected $fillable=[
        'course_id',
        'user_id'
    ];
}
