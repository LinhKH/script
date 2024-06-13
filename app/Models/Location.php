<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table ="locations";

    protected $fillable = [
        'location',
        'location_slug',
        'image',
        'status',
    ];

    public function plan()
    {
       return $this->hasMany(Plan::class,'location','id');
    }
}

