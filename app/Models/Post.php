<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comment()
{
    return $this->belongsToMany(Comment::class,'comment_post');
}

    protected $table='post';
}
