<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'model',
        'clearName',
        'description',
        'image',
        'nbPlaces',
        'price',
        'isRented'
    ];

    public function renter()
    {
        return $this->hasOne(User::class);
    }
}
