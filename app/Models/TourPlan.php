<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPlan extends Model
{
    use HasFactory;

    protected $table ="tour_plan";

    protected $fillable = [
        'title',
        'sub_title',
        'description',
    ];
}
