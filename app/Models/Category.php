<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class Category extends Model
{
    use HasFactory;

    protected $table ="categories";

    protected $fillable = [
        'title',
        'status',
    ];

    public function plans(){
        return $this->hasMany(Plan::class,'category','id');
    }
}
