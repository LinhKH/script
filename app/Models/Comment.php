<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'b_comments';

    protected $fillable = [
       'comment',
       'blog_id',
       'user_id',
       'parent_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function blog(){
        return $this->belongsTo(Blog::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class,'parent_id','blog_id');
    }
}
