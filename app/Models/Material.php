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

    public function material_type(){
        return $this->belongsTo(MaterialType::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

}
