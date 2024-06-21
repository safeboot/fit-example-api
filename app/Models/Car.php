<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'model',
        'year',
        'price',
        'brand_id'

    ];

    public function brand() {

        return $this->belongsTo(Brand::class);

    }
}
