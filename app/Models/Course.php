<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    use HasFactory,Sluggable;

    protected $fillable=[
        'title',
        'description',
        'category_id',
        'level_id',
        'certificate',
        'user_id',
        'status_id'
    ];

    

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'course_units');
    }


    public function enrollusers()
    {
        return $this->belongsToMany(User::class)->withPivot('id')->withTimestamps();
    }
    public function getIsArchivedAttribute()
    {
        return $this->status_id==Status::ARCHIVED;
    }

    public function getIsDraftAttribute()
    {
        return $this->status_id==Status::DRAFT;
    }

    public function getIsPublishedAttribute()
    {
        return $this->status_id==Status::PUBLISHED;
    }

    public function scopeVisibleTo($query)
    {
        return $query->where('user_id',Auth::id());
    }

    public function scopeActive($query)
    {
        return $query->whereIn('category_id',Category::visibleTo(Auth::user())->active()->get()->pluck('id')->toArray());
    }

    public function images()
    {
        return $this->hasOne(CourseImage::class);
    }


    public function scopeSearch($query,array $filter)
    {

        dd($filter);
        $query->when($filter['search'] ?? false,function($query,$search)
        {
            return $query
                ->where('title','like','%'. $search . '%')
                ->orwhere('description','like','%'. $search .'%');
        }
        );


        if(request()->has(['search','category']) && request(['category']))
        {

        }
        $query->when($filter['category'] ?? false,function($query,$search)
        {
            return $query
                ->where('category_id',$search);
        }
        );

        $query->when($filter['level']?? false,function($query,$search)
        {
            return $query
            ->where('level_id',$search);
        });

        $query->when($filter['newest']?? false,function($query)
        {
            return $query->orderby('created_at','desc');
        });

        $query->when($filter['sort']?? false,function($query)
        {
            return $query->orderby('title','asc');
        });

        $query->when($filter['sort-reverse']?? false,function($query)
        {
            return $query->orderby('title','desc');
        });

    }
}
