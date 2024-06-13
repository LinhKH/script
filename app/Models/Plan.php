<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Location;
use App\Models\TourPlan;

class Plan extends Model
{
    use HasFactory;

    protected $table ="plans";

    protected $fillable = [
        'title',
        'title_slug',
        'category',
        'tour_plan',
        'start_time',
        'end_time',
        'location',
        'duration',
        'capacity',
        'price',
        'includes',
        'excludes',
        'gallery',
        'description',
        'status',
    ];

    public function catName()
    {
       return $this->hasOne(Category::class,'id','category');
    }

    public function locationName()
    {
       return $this->hasOne(Location::class,'id','location');
    }

    public function tourPlan()
    {
       return $this->hasMany(TourPlan::class,'plan_id','id');
    }


    // public function booking()
    // {
    //    return $this->hasOne(Booking::class,'id','plan_id');
    // }

}
