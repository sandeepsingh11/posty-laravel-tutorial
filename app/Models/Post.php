<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'user_id'
    ];

    /**
     * Check if the current user has already liked this post.
     * 
     * @var User
     *
     * @return bool
     */
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {
        // access which user this post instance belongs to
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
