<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comment';
    public function post()
{
    return $this->belongsToMany(Post::class,'comment_post');
}
}
