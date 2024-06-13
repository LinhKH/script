<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'title_slug',
        'image',
        'description',
        'category',
        'author',
        'status',
    ];

    public function blog_category(){
        return $this->hasOne(BlogCategory::class,'id','category');
    }
}
