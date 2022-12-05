<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'test_questions';

    protected $fillable = [
        'question'
    ];

    public function tests()
    {
        return $this->belongsToMany(Test::class,'test_question')
                    ->withPivot('id')
                    ->withTimestamps()
                    ->using(TestQuestion::class);
    }
}
