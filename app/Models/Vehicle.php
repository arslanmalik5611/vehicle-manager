<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['image_url'];


    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    public function vehicle_type(){
        return $this->belongsTo(VehicleType::class);
    }

    public function vehicle_insurance(){
        return $this->hasOne(VehicleInsurance::class);
    }

    public function vehicle_mechanical(){
        return $this->hasOne(VehicleMechanical::class);
    }

    public function vehicle_license(){
        return $this->hasOne(VehicleLicense::class);
    }

    public function getImageUrlAttribute()
    {
        if (!empty($this->image)) {
            return asset('uploads/vehicle-attachment'). '/' . $this->image;
            // return asset('panel_assets/l.png');
//            return env('BASE_URL') . ('uploads/students/') . $this->picture;
        }
    }

    protected static function booted()
    {
        // static::deleting(function ($School) {
        //     foreach ($Vehicle->insurance as $insurance) {
        //         $insurance->delete();
        //     }
        // });
    }
}
