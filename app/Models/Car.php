<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'isFreeRented' => 'boolean',
        'isRented' => 'boolean'
    ];

    protected $fillable = [
        'model',
        'clearName',
        'description',
        'image',
        'nbPlaces',
        'price',
        'isFreeRented',
        'isRented',
        'costIfRented',
        'locationDaysNumber'
    ];

    public function renter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
