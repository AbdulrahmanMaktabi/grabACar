<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Car extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "name",
        "owner_id",
        "marker_id",
        "model_id",
        "carType_id",
        "fuel_id",
        "year",
        'image',
        'price',
        'vin',
        'mileage',
        'address',
        'description',
        'car_specifications',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function marker()
    {
        return $this->belongsTo(Marker::class, 'marker_id');
    }

    public function fuel()
    {
        return $this->belongsTo(fuel::class, 'fuel_id');
    }
}
