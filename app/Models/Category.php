<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'status',
        'slug',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
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
