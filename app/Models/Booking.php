<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;

    protected $table ="booking";

    protected $fillable = [
        'user_id',
        'plan_id',
        'pay_id',
        'seats',
        'amount',
    ];

    public function plan()
    {
       return $this->hasOne(Plan::class,'id','plan_id')->with('catName','locationName');
    }

    public function user()
    {
       return $this->hasOne(User::class,'id','user_id');
    }
}
