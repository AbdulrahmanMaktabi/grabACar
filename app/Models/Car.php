<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Car extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug, SoftDeletes;

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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function marker()
    {
        return $this->belongsTo(Marker::class, 'marker_id');
    }

    public function model()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }

    public function carType()
    {
        return $this->belongsTo(car_type::class, 'carType_id');
    }

    public function fuel()
    {
        return $this->belongsTo(fuel::class, 'fuel_id');
    }

    // Accessors
    public function getPriceAttribute($value)
    {
        return $value . " $";
    }

    public function getMileageAttribute($value)
    {
        return $value . " KM";
    }

    // Mutator
    protected function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace('$', '', $value);
    }

    protected function setMileageAttribute($value)
    {
        $this->attributes['mileage'] = str_replace(' KM', '', $value);
    }
}
