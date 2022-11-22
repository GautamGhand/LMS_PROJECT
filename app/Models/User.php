<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;
use Cviebrock\EloquentSluggable\Sluggable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes,ReceivesWelcomeNotification,Sluggable;
    
    CONST ACTIVE=1;

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => ['first_name','last_name']
            ]
        ];
    }

    public function role()
    {
       return  $this->belongsTo(Role::class);
    }


    public function categories()
    {
       return  $this->hasMany(Category::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getIsEmployeeAttribute() {
        return $this->role_id==Role::EMPLOYEE;
    }

    public function getIsTrainerAttribute()
    {
        return $this->role_id==Role::TRAINER;
    }

    public function getIsSubAdminAttribute()
    {
        return $this->role_id==Role::SUB_ADMIN;
    }

    public function getIsEmailStatusActiveAttribute()
    {
        return $this->email_status==self::ACTIVE;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function scopeSearch($query,array $filter)
    {
        $query->when($filter['search'] ?? false,function($query,$search)
        {
            return $query
                ->where('first_name','like','%'. $search . '%')
                ->orwhere('email','like','%'. $search .'%');
        }
        );

        $query->when($filter['role'] ?? false,function($query,$search)
        {
            return $query
                ->where('role_id',$search);
        }
        );

        $query->when($filter['newest']?? false,function($query)
        {
            return $query->orderby('created_at','desc');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'slug',
        'email',
        'created_by',
        'gender',
        'phone',
        'password',
        'image',
        'email_status',
        'status',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
