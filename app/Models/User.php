<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // create User - Post relationship
    public function posts()
    {
        // laravel will map User->id to Post->user_id
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        // user likes a post (not how many they have received)
        return $this->hasMany(Like::class);
    }

    public function likesReceived()
    {
        // user has many likes through many posts
        // ~many likes foreach post
        return $this->hasManyThrough(Like::class, Post::class);
    }
}
