<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    protected $appends = ['image_url'];


    public function material_type(){
        return $this->belongsTo(MaterialType::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function getImageUrlAttribute()
    {
        if (!empty($this->image)) {
            return asset('uploads/vehicle-attachment'). '/' . $this->image;
            // return asset('panel_assets/l.png');
//            return env('BASE_URL') . ('uploads/students/') . $this->picture;
        }
    }

}
