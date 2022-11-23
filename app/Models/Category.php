<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory,Sluggable,SoftDeletes;

    CONST ACTIVE=true;
    protected $fillable=[
        'name',
        'status',
        'slug',
        'user_id'
    ];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status',self::ACTIVE);
    }

    public function scopeVisibleTo($query)
    {
        return $query->where('user_id',Auth::id());
    }

    public function scopeSearch($query,array $filter)
    {
        $query->when($filter['search'] ?? false,function($query,$search)
        {
            return $query
                ->where('name','like','%'. $search . '%')
                ->orwhere('slug','like','%'. $search .'%');
        }
        );

         $query->when($filter['newest'] ?? false,function($query)
        {
            return $query
                ->orderby('created_at','desc');
        }
        );
    }
}
