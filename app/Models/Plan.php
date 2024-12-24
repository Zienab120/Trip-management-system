<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = ['name', 'price', 'description', 'features'];

    // public function features()
    // {
    //     return $this->belongsToMany(Feature::class, 'feature_plan');
    // }
}
