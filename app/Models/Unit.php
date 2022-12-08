<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory,Sluggable;

    protected $fillable=[
        'name',
        'description',
        'slug',
        'duration'
    ];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    
}
