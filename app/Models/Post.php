<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image_url',
        'time_label',
        'base_likes',
        'base_comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function totalLikesCount(): int
    {
        return $this->base_likes + $this->likes()->count();
    }

    public function totalCommentsCount(): int
    {
        return $this->base_comments + $this->comments()->count();
    }
}
