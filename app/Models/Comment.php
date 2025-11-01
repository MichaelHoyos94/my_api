<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Models\Post;
use App\Http\Models\User;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'comment',
        'post_id',
        'user_id'
    ];
    public function post() {
        return $this->belongsTo(Post::class);
    }
    public function user() {
        return $this->belongsTo(user::class);
    }
}
