<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    use HasFactory;

    protected $table = 'review_ratings';

    protected $fillable = [
       'plan_id',
       'user_id',
       'star_rating',
       'comment',
       'status',
    ];
}
