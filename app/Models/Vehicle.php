<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'vehicle_model_id',
        'color_id',
        'title',
        'main_photo_url',
        'year',
        'mileage',
        'price',
        'transmission',
        'fuel_type',
        'doors',
        'description',
        'features',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function photos()
    {
        return $this->hasMany(VehiclePhoto::class)->orderBy('position');
    }
}
